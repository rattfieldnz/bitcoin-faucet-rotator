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
        if (Auth::user()) {
            $this->userId = Auth::user()->id;
            $adBlock = User::find($this->userId)->firstOrFail()->adBlock;
            if($adBlock) {
                return $adBlock->ad_content;
            }
            return null;
        }
        $adminAdBlock = User::where('is_admin', '=', true)->firstOrFail()->adBlock;
        if($adminAdBlock){
            return $adminAdBlock->ad_content;
        }
        return null;

    }
}
