<?php

use App\Models\Agency;
use Illuminate\Database\Seeder;

class AgenciesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void`
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('agencies')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->addRecord("Thomas & Betts", "1811 Hymus Blvd", "Dorval", "QC", "H9P 1J5", "901-252-5000", "www.tnb.com");
        $this->addRecord("Archibald & Meek  Inc.", "537 Wrightwood Avenue", "Elmhurst", "IL", "60126", "630-833-7377", "www.amirep.com");
        $this->addRecord("Architectural Lighting Solutions", "970 Canyon Breeze Lane", "Draper", "UT", "84020", "801-232-2276", "www.alsutah.com.com");
        $this->addRecord("Bright Technologies", "8125 West Grand Ave, Suite LL", "Littleton", "CO", "80123", "720-465-7122", "www.btco.co");
        $this->addRecord("Cascade Lighting", "128 NE 7th Avenue", "Portland ", "OR", "97232", "503-242-2522", "www.cascadelight.com");
        $this->addRecord("Gormley-Farrington, inc", "339 Haymaker Rd, suite 1103", "Monroeville ", "PA", "15146", "412-856-5740", "www.gormley-farrington.com");
        $this->addRecord("Gormley-Farrington, inc (Sub Office: West Virginia)", "5960 Route 60 E., Suite 3", "Barboursville", "WV", "25504", "304-736-2849", "no web site");
        $this->addRecord("Gormley-Rowsey Associates", "5960 Route 60 E., Suite 3, PO Box 343", "Barboursville", "WV", "25504", "304-736-2849", "no web site");
        $this->addRecord("Intergated Sales", "527 Main Street", "Van Meter", "IA", "50261", "515-528-7463", "www.int-sales.com");
        $this->addRecord("Intergated Sales (Sub Office)", "12044 Roberts Road", "La Vista", "NE", "68128-5577", "402-289-9600", "no web site");
        $this->addRecord("JTH Lighting Alliance", "6885 146th St. West", "Apple Valley", "MN", "55124", "952-223-6300", "www.jthlighting.com");
        $this->addRecord("JTH Lighting Alliance (Sub Office-Iowa)", "319 SW 5th Street", "Des Moines", "IA", "50309", "515-650-8114", "no web site");
        $this->addRecord("JTH Lighting Alliance (Sub Office-Iowa)", "1930 Saint Andrews Court NE, Suite A", "Cedar Rapids", "IA", "52402", "515-650-8115", "no web site");
        $this->addRecord("Kevin Lehr Associates", "2000 W. Henderson Rd, Suite 40", "Columbus", "OH", "43220", "614-299-8599", "no web site");
        $this->addRecord("Klondike Sales", "201 E 54TH Avenue #202", "Anchorage", "AK", "99518", "907-562-7000", "www.klondikesales.com");
        $this->addRecord("Langlais Group", "11 Sea Pave Rd", "South Windsor", "CT", "O6074", "860-648-2372", "www.langlaisgroup.com");
        $this->addRecord("LASR Lighting", "516 Alhambra Avenue", "Martinez", "CA", "94553", "925-335-3090", "no web site");
        $this->addRecord("Meglio & Associates", "14220 Laude Road", "Chesterfield", "MO", "63017", "314-524-4424", "www.meglio.com");
        $this->addRecord("Meglio & Associates (Sub Office: Meglio-ESI)", "9917 Pflumm Road", "Lenexa", "KS", "66215", "913-397-6000", "no web site");
        $this->addRecord("NorthCoast Engineered Lighting", "27101 E Oviott, Suite 11", "Bay Village", "OH", "44140", "440-499-5233", "no web site");
        $this->addRecord("Northern Rockies Agency", "246 Timberline Drive", "Bozeman", "MT", "59718", "406-587-0513", "www.nrarep.net");
        $this->addRecord("PB Lighting Associates", "17 Bannard Street, Suite 30", "Freehold", "NJ", "O7728", "732-462-3163", "www.pblighting.com");
        $this->addRecord("Red Leonard Associates", "1340 Kemper Meadow", "Cincinnati", "OH", "45240", "513-574-9500", "www.redleonard.com");
        $this->addRecord("Russo Lighting", "80 Swalm Street", "Westbury", "NY", "11590", "516-997-4250", "www.russolighting.com");
        $this->addRecord("Solid State Lighting Hawaii-SSLH", "321 Mokauea Street, Unit A", "Honolulu", "HI", "96819", "808-439-6450", "www.solidstatehawaii.com");
        $this->addRecord("Stuart Lighting Sales", "28 Old Stevens Lane", "Voorhees", "NJ", "08043", "856-782-7585", "no web site");
        $this->addRecord("Sunrise Lighting Systems", "360 W. Bedford Suite #116", "Fresno", "CA", "93711", "559-435-6090", "www.sunriselightingsystems.com");
        $this->addRecord("Tri-Lite Sales-LA", "1754 Watterson Trail", "Louisville", "KY", "40299", "877-999-2766", "no web site");
        $this->addRecord("Visual Impact Lighting", "1724 Industrial Drive", "Green Bay", "WI", "54302", "920-437-2069", "www.visualimpactlighting.com");
        $this->addRecord("Visual Impact Lighting (sub office-Madsion)", "327 North Kerch Steet", "Brooklyn", "WI", "53521", "", "no web site");
    }

    private function addRecord($name, $address, $city, $state, $zipcode, $phone, $website)
    {
        Agency::create([
            'name'           => $name,
            'phone'          => $phone,
            'address'        => $address,
            'city'           => $city,
            'state_province' => $state,
            'postal_code'    => $zipcode,
            'website'        => $website,
            'is_approved'    => rand(0, 1),
        ]);
    }
}
