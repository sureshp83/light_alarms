<?php

use App\User;
use App\Models\Agency;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');


        // T&B Users (used for testing)
        $this->addTNBUser('T&B Super Admin','admintest@designshopp.com','Administrator',1);
        $this->addTNBUser('T&B Agency Admin','agencyadmintest@designshopp.com','Principal',2);
        $this->addTNBUser('T&B Agent','agenttest@designshopp.com','',3);

        // Seed random T&B Agents, not approved
        // Note: "Thomas & Betts" has id = 1
        factory(User::class, 15)->create([
            'agency_id'   => 1,
            'role_id'     => 3,
            'is_approved' => 0,
        ]);

        $this->addUser("Archibald & Meek Inc.","Joe Archibald III","Principal","630-881-2700","joe@amirep.com");
        $this->addUser("Archibald & Meek Inc.","Richard Meek","Principal","630-292-0218","richard@amirep.com");
        $this->addUser("Archibald & Meek Inc.","Ray Doerrer","Quotations Manager","630-222-0637","ray@amirep.com");
        $this->addUser("Archibald & Meek Inc.","Jenny Martin","Manager of Operations","612-735-8584","jenny@amirep.com");
        $this->addUser("Architectural Lighting Solutions","Greg Gust","Principal","801-232-2276","ggust@alsutah.com");
        $this->addUser("Bright Technologies","Nick Lahey","Principal","720-545-4251","nick@btco.co");
        $this->addUser("Bright Technologies","Shannon Yarish","Office Manager / Specification sales","720-480-9519","shannon@btco.co");
        $this->addUser("Bright Technologies","Tony Edwards","Outside Sales","720-582-2330","tony@btco.co");
        $this->addUser("Cascade Lighting","Jack Aubert","Principal","503-969-3435","jaubert@cascadelight.com");
        $this->addUser("Gormley-Farrington, inc","Pat Gormley","Principal","412-848-0482","patg@gormley-farrington.com");
        $this->addUser("Gormley-Farrington, inc","Nancy Gormley","Marketing/Project Manager","","nancy@gormley-farrington.com");
        $this->addUser("Gormley-Farrington, inc","Andy Andoga","Outside Sales","412-292-1319","aandoga@gormley-farrington.com");
        $this->addUser("Gormley-Rowsey Associates","Dan Rowsey","Outside Sales","304-416-2370","dan.rowsey@gormley-rowsey.com");
        $this->addUser("Gormley-Rowsey Associates","Joy Ash","Inside sales","","joy.ash@gormley-rowsey.com");
        $this->addUser("Gormley-Rowsey Associates","Chip Thompson","Inside sales","","chip.thompson@gormley-rowsey.com");
        $this->addUser("Intergated Sales","Jarret Golwitzer","President","515.564.9801","jgolwitzer@int-sales.com");
        $this->addUser("Intergated Sales (Sub Office)","Mark Constable","Inside Sales","","mconstable@int-sales.com");
        $this->addUser("JTH Lighting Alliance","Jon Kirkhoff","President of Sales","612-816-7145","jonk@jthlighting.com");
        $this->addUser("JTH Lighting Alliance (Sub Office-Iowa)","Rob Beaman","President","319-533-5176","rgb@jthlighting.com");
        $this->addUser("JTH Lighting Alliance (Sub Office-Iowa)","Chad Leidigh","Sales/Iowa","515-450-2102","chadl@jthlighting.com");
        $this->addUser("Kevin Lehr Associates","Kevin Lehr","","","klehrkla@aol.com");
        $this->addUser("Klondike Sales","Keith White","Principal","","kwhite@klondikesales.com");
        $this->addUser("Klondike Sales","Robin White","Inside Sales","","rwhite@klondikesales.com");
        $this->addUser("LASR Lighting","Ben Guzman","Principal","","lasrltg@sbcglobal.net");
        $this->addUser("Langlais Group","Art Langlais","Principal","860-836-2208","art@langlaisgroup.com");
        $this->addUser("Langlais Group","Skip Popiak","Principal","860-601-0486","skip@langlaisgroup.com");
        $this->addUser("Meglio & Associates","David Meglio","Principal","314-610-7139","dmeglio@meglio.com");
        $this->addUser("Meglio & Associates","Mike Meglio","Principal","314-570-7454","mmeglio@meglio.com");
        $this->addUser("Meglio & Associates","Amada Hoff","Quotes","314-751-5094","ahoff@meglio.com");
        $this->addUser("Meglio & Associates (Sub Office: Meglio-ESI)","Joni Stegman","","","jstegman@meglio-esi.com");
        $this->addUser("Meglio & Associates (Sub Office: Meglio-ESI)","Greg Llyod","","","glloyd@meglio-esi.com");
        $this->addUser("Meglio & Associates (Sub Office: Meglio-ESI)","George Johnson","","","gjohnson@meglio-esi.com");
        $this->addUser("Meglio & Associates (Sub Office: Meglio-ESI)","Don Long","","","dlong@meglio-esi.com");
        $this->addUser("NorthCoast Engineered Lighting","Rhonda Jones","Principal","785-917-0606","rhonda@northcoasteps.com");
        $this->addUser("Northern Rockies Agency","Jim Armstrong","Principal","","jim@nrarep.com");
        $this->addUser("Northern Rockies Agency","Tom Craver","Principal","","tom@nrarep.com");
        $this->addUser("Northern Rockies Agency","Bill DeBuse","Principal","","bill@nrarep.com");
        $this->addUser("PB Lighting Associates","Peter Wicox","","732-995-5227","peterw@pblighting.com");
        $this->addUser("Red Leonard Associates","Jayme Leonard","Principal","513-702-6090","jaymeleonard@me.com");
        $this->addUser("Red Leonard Associates","John Bruening","C&I Sales","","john.bruening@redleonard.com");
        $this->addUser("Russo Lighting","Joe Russo","Principal","516-6522519","jrusso@russolighting.com");
        $this->addUser("Russo Lighting","Eddie Miles","Inside Sales","","emiles@russolighting.com");
        $this->addUser("Solid State Lighting Hawaii-SSLH","Chip Richards","President","","chip@solidstatehawaii.com");
        $this->addUser("Stuart Lighting Sales","Randy Stuart","","609-519-8275","randysls@comcast.net");
        $this->addUser("Sunrise Lighting Systems","Robert McVicar","President","559-288-1883","robert@sunriselightingsystems.com");
        $this->addUser("Tri-Lite Sales-LA","David Wilson","Principal","","david@tri-litesales.com");
        $this->addUser("Tri-Lite Sales-LA","Dale Keathley","Sales Manager","","dale@tri-litesales.com");
        $this->addUser("Tri-Lite Sales-LA","Norma Wilson","Customer service/Account","","norma@tri-litesales.com");
        $this->addUser("Visual Impact Lighting","Dave Zochert","President","920-371-3025","dave@visualimpactlighting.com");
        $this->addUser("Visual Impact Lighting","Kylie Rutkowski","Operations","","kylie@visualimpactlighting.com");
        $this->addUser("Visual Impact Lighting (sub office-Madsion)","Scott Zagrodnik","Outside Sales","","scott@visalimpactlighting.com");
    }

    /**
     * Create T&B User
     */
    private function addTNBUser($name, $email, $position, $role_id)
    {
        $user = User::create([
            'role_id'     => $role_id,
            'agency_id'   => 1,
            'is_approved' => 1,
            'position'    => $position,
            'name'        => $name,
            'email'       => $email,
            'password'    => bcrypt('Sdf423jlJH'),
        ]);
    }

    /**
     * Create User
     */
    private function addUser($agency, $name, $position, $phone, $email, $password = '')
    {
        $agency = Agency::where('name', $agency)->first();

        if (!$agency) {
            return;
        }

        $role = $position === 'Principal' ? 2 : 3;

        $user = User::create([
            'role_id'     => $role,
            'agency_id'   => $agency->id,
            'is_approved' => 1,
            'position'    => $position,
            'name'        => $name,
            'email'       => $email,
            'password'    => bcrypt(str_random(8)),
            'phone'       => $phone,
        ]);
    }
}
