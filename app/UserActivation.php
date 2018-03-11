<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserActivation extends Model
{
    protected $table = 'user_activations';

    protected function getToken(){
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function createActivation($user){
        $activation = $this->getActivation($user);
        // neu chua co token
        if(!$activation){
            //create new token
            return $this->createToken($user);
        }
        // update token
        return $this->regenerateToken($user);
    }
    private function createToken($user){
        $token = $this->getToken();
        // lưu activation
        UserActivation::insert([
            'user_id' => $user->id,
            'activation_code' => $token
        ]);
        return $token;
    }

    private function regenerateToken($user){
        $token = $this->getToken();
        UserActivation::where('user_id',$user->id)->update([
            'activation_code'->$token
        ]);
        return $token;
    }
    public function getActivation($user){
        return UserActivation::where('user_id',$user->id)->first();
    }

    public function getActivationByToken($token)
    {
        return UserActivation::where('activation_code', $token)->first();
    }

    public function deleteActivation($token)
    {
        UserActivation::where('activation_code', $token)->delete();
    }
}
