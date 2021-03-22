<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class ConverterTest extends TestCase
{
    //Checks if Converter Api returns converted result as a number

    public function testConvert(): void
    {
        $converter = new Api\models\Converter;
        $converter->src_currency = "DKK";
        $converter->tar_currency = "PKR";
        $converter->amount = 2000;        
        $convert_result = $converter->convert();
        $this->assertNotNull(  
            $convert_result,  
            "Result is null or not"
        );  
        $this->assertIsNumeric($convert_result);
    }

}



