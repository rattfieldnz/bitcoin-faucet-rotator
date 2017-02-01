<?php namespace Helpers\Functions;

use App\AdBlock;
use App\User;
use Illuminate\Support\Facades\Auth;

/**
 * Class Ads
 *
 * A class to handle functionality specific to the
 * site-wide ad block.
 *
 * @author Rob Attfield <emailme@robertattfield.com> <http://www.robertattfield.com>
 * @package Helpers\Functions
 */
class Ads
{
    private $userId;

    /**
     * A function to retrieve the site-wide ad block
     * from the database.
     *
     * @return mixed
     */
    public function get()
    {
        $adminAdBlock = null;
        if (Auth::user()) {
            $this->userId = Auth::user()->id;
            //dd($this->userId);
            $adminAdBlock = User::find($this->userId)->firstOrFail()->adBlock;
            if($adminAdBlock == null){
                return null;
            }
        }
        //dd(User::where('is_admin', '=', true)->firstOrFail()->adBlock);
        $adminAdBlock = User::where('is_admin', '=', true)->firstOrFail()->adBlock;
        return $adminAdBlock->ad_content;
    }
}