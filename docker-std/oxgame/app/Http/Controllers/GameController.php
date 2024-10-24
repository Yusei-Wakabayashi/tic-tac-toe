<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Str;

class GameController extends Controller
{
    //
    public function getrooms()
    {
        $room_object = new Room;
        $data = $room_object->getrooms();
        return $data;//参加可能なroomがあれば1件のデータを返す
    }
    public function nowbattleroom($usersession)
    {
        $room_object = new Room;
        $data = $room_object->nowbattleroom($usersession);
        if ($data === null)
        {
            //戦闘中のroomがない
            return $data;
        }
        else
        {
            if (count($data) === 1)
            {
                return $data;//戦闘中のroomを取得
            }
            else
            {
                abort(500, '異常な数値');//戦闘中のルームが2以上あるためおかしい
            }
        }
    }
    public function inroom($usersession)
    {
        $room_object = new Room;
        $inroom_data = $room_object->inroom($usersession);
        return $inroom_data;//待機状態
    }
    public function createroom(Request $request)
    {
        //どんな状態であってもroomを一つ作成する
        $room_object = new Room;
        $room_object->createroom($request->cookies->get("laravel_session"));
        return view('matching');
    }
    public function session(Request $request)
    {
        //セッションの内容確認用
        dump($request->cookies->get("laravel_session"));
    }
    public function checkroom(Request $request)
    {
        $room_object = new Room;
        $session = $request->cookies->get("laravel_session");
        $nowbattleroom_data = GameController::nowbattleroom($session);
        $inroom_data = GameController::inroom($session);
        $getroom = GameController::getrooms();
        if ($nowbattleroom_data)
        {
            //戦闘に復帰する処理
            return view('matching');
        }
        elseif ($inroom_data)
        {
            //待機状態に復帰する処理
            return view('matching');
        }
        elseif ($getroom)
        {
            //roomに参加する処理
            $room_object->addroom($getroom['roomid'], $session);
            return view('matching');
        }
        else
        {
            //戦闘状態でもなく待機状態でもなく参加可能なroomもないためroomを作成する
            $room_object->createroom($request->cookies->get("laravel_session"));
            return view('matching');
        }
    }
}
