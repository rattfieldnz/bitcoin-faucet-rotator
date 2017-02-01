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
            return User::find($this->userId)->firstOrFail()->adBlock->ad_content;
        }
        return User::where('is_admin', '=', true)->firstOrFail()->adBlock->ad_content;
    }
}