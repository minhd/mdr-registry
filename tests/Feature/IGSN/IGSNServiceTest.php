<?php


namespace Tests\Feature\IGSN;


use App\Events\RecordCreated;
use App\Events\RecordUpdated;
use App\IGSN\IGSNService;
use App\IGSN\Models\IGSNClient;
use App\IGSN\Models\IGSNPrefix;
use App\Registry\DataCiteClient;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class IGSNServiceTest extends TestCase
{
    use RefreshDatabase;

    // TODO make this test work
    function it_should_mint_an_igsn()
    {
        $igsn = resource_path('tests/igsn/XXAB00000.xml');
        $url = "http://test.example";

        // given an authenticated user
        $john = signIn();

        // this user is also an IGSN client
        $client = factory(IGSNClient::class)->create(['user_id' => $john->id]);

        // that client has an active prefix
        $prefix = factory(IGSNPrefix::class)->create();
        $client->prefixes()->save($prefix);
        $client->setActivePrefix($prefix);

        $dataCiteMock = Mockery::mock(DataCiteClient::class);
        $dataCiteMock->shouldReceive('mint')->once()->andReturnTrue();

        $service = new IGSNService($dataCiteMock, $client);

        // there would be a record created
        $this->expectsEvents(RecordCreated::class);
        $this->doesntExpectEvents(RecordUpdated::class);

        // when the user mint
        $result = $service->mint($url, $igsn);
        $this->assertTrue($result);

        // igsn is in the database
        $this->assertCount(1, $client->datasource->records);
        $record = $client->datasource->records->first();
        $version = $record->current;

        $this->assertEquals('igsn', $version->schema);
        $this->assertEquals($igsn, $version->data);

        // TODO test the identifier is existence and links to the record
    }

}
