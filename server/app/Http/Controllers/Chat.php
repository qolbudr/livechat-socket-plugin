<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chats;
use Illuminate\Support\Facades\DB;

class Chat extends Controller
{
    public function get_all_chat($chat_id, $from_id) {
        $chat = DB::select("select * from chat where id in (
            select max(id) from (select chat.from_id as fromId, chat.to_id as toId, chat.* from chat,
            (select chat_id, from_id, message,
            max(created_at) as time from chat
            group by chat_id, from_id, to_id) last_chat
            where chat.chat_id=last_chat.chat_id
            and chat.from_id=last_chat.from_id
            and chat.created_at=last_chat.time
            and chat.chat_id = '$chat_id'
            and chat.from_id = $from_id
            UNION select chat.from_id as toId, chat.to_id as fromId, chat.* from chat,
            (select chat_id, from_id, message,
            max(created_at) as time from chat
            group by chat_id, from_id, to_id) last_chat
            where chat.chat_id=last_chat.chat_id
            and chat.from_id=last_chat.from_id
            and chat.created_at=last_chat.time
            and chat.chat_id = '$chat_id'
            and chat.to_id = $from_id) t)");

        return response()->json($chat);
    }

    public function send_message($chat_id, $from_id, $to_id, $from_name, $to_name, $message) {
        $chat = new Chats();
        $chat->chat_id = $chat_id;
        if($from_id < $to_id) {
            $chat->group_id = $from_id.$to_id;
        } else {
            $chat->group_id = $to_id.$from_id;
        }
        $chat->to_id = $to_id;
        $chat->from_id = $from_id;
        $chat->from_name = $from_name;
        $chat->to_name = $to_name;
        $chat->message = $message;
        $chat->save();

        return response()->json(['status' => 'message has been sent']);
    }

    public function get_all_message($chat_id, $from_id, $to_id) {
        $first = Chats::where('chat_id', $chat_id)
                      ->where('from_id', $from_id)
                      ->where('to_id', $to_id);
        $chat = Chats::where('chat_id', $chat_id)
                      ->where('from_id', $to_id)
                      ->where('to_id', $from_id)
                      ->union($first)
                      ->orderBy('created_at', 'ASC')
                      ->get();

        return response()->json($chat);
    }
}
