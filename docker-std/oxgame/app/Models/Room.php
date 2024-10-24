<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $fillable = [
        'user1_session',
        'user2_session',
        'roomsitu'
    ];

    public function getrooms()
    {
        $data = Room::whereNull('user2_session')->first();
        return $data;//参加可能なroomの取得
    }
    public function addroom($roomid, $user2session)
    {
        //参加可能なroomに参加
        Room::where('roomid', '=', "$roomid")->update(['user2_session' => $user2session]);
    }
    public function createroom($user1session)
    {
        //roomを作成する
        Room::create([
            'user1_session' => $user1session
        ]);
    }
    public function inroom($usersession)
    {
        //待機状態にあるroomの取得
        Room::where('user1_session', '=', "$usersession")
            ->orWhere('user2_session', '=', "$usersession")
            ->where('roomsitu', '=', 0)
            ->get();
    }
    public function nowbattleroom($usersession)
    {
        //戦闘状態のroomの取得
        Room::where('user2_session', '=', "$usersession")
            ->orWhere('user1_session', '=', "$usersession")
            ->where('roomsitu', '=', 1)
            ->get();
    }
    public function changebattle($roomid)
    {
        //roomの状態を戦闘状態に移行
        Room::where('roomid', '=', "$roomid")
            ->update([
                'roomsitu' => 1
            ]);
    }
}
