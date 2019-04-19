<?php

namespace App\Services;

/**
 * Class GoogleSheetsService
 * @package App\Services
 */
class GoogleSheetsService
{
    /**
     * @var null|\Google_Client
     */
    private $client;

    /**
     * @var string
     */
    private $sheetId;

    /**
     * GoogleSheetsService constructor.
     * @param $sheetId
     */
    public function __construct()
    {
        try {
            $client = new \Google_Client();

            $client->setApplicationName('Eadrama APP');
            $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
            $client->setAccessType('offline');
            $client->setAuthConfig(storage_path('token.json'));

            $this->client = $client;
        } catch (\Exception $e) {
            $this->client = null;
        }

        $this->sheetId = env('COVER_MOVIE_SHEETS');
    }

    /**
     * @return array
     */
    public function coverMovies()
    {
        $data   = [];
        $sheets = new \Google_Service_Sheets($this->client);

        // The first row contains the column titles, so lets start pulling data from row 2
        $currentRow = 2;
        $range      = 'A2:I';
        $rows       = $sheets->spreadsheets_values->get($this->sheetId, $range, ['majorDimension' => 'ROWS']);
        if (isset($rows['values'])) {
            foreach ($rows['values'] as $row) {
                /*
                 * If first column is empty, consider it an empty row and skip (this is just for example)
                 */
                if (empty($row[0])) {
                    break;
                }

                $data[] = [
                    'name'        => $row[1],
                    'image'       => $row[2],
                    'country'     => $row[3],
                    'genres'      => $row[4],
                    'year'        => $row[5],
                    'status'      => $row[6],
                    'description' => substr($row[7], 0, 200),
                    'url'         => $row[8],
                ];

                $currentRow++;
            }
        }

        return $data;
    }
}
