<?php namespace Helpers\Functions;

use App\AdBlock;
use App\User;
use Illuminate\Support\Facades\Auth;

class Ads
{
    private $userId;
    /**
     * @param $userId
     * @return AdBlock ad
     */
    public function get()
    {
        if (Auth::user()) {
            $this->userId = Auth::user()->id;
            return User::find($this->userId)->firstOrFail()->adBlock->ad_content;
        }
        return User::where('is_admin', '=', true)->firstOrFail()->adBlock->ad_content;

    }
}
