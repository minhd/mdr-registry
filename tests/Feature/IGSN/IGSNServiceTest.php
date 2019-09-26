<?php


namespace Tests\Feature\IGSN;


use App\IGSN\IGSNService;
use App\Registry\DataCiteClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class IGSNServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function it_should_mint_an_igsn()
    {
        $igsn = resource_path('tests/igsn/XXAB00000.xml');
        $url = "http://test.example";

        $dataCiteMock = Mockery::mock(DataCiteClient::class);
        $dataCiteMock->shouldReceive('mint')->once()->andReturnTrue();

        $service = new IGSNService($dataCiteMock);

        // mint is successful
        $result = $service->mint($url, $igsn);
        $this->assertTrue($result);

        // igsn is in the database

        // TODO test the igsn is in the database
        // TODO test the xml is a new version -> record, in the proper datasource
        // TODO test the identifier is existence and links to the record
    }

}
