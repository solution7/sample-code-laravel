<?php

namespace Tests\Feature;

use Tests\BaseTestCase;

use Illuminate\Database\Eloquent\Model;

use App\Helpers\StringHelper;

class StringHelperTest extends BaseTestCase
{
    /** @test */
    public function it_can_convert_to_hungarian_notation()
    {
        $string = "AWESOME_CAPS_STRING";
        $stringWithHungarianNotation = StringHelper::toCamelCase($string);

        $this->assertEquals($stringWithHungarianNotation, "awesomeCapsString");
    }
}
