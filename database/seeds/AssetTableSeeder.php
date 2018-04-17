<?php

use Illuminate\Database\Seeder;
use EONConsulting\ContentBuilder\Models\Asset;
use EONConsulting\ContentBuilder\Models\Category;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local as Adapter;
use EONConsulting\TaoClient\Services\UUID;

class AssetTableSeeder extends Seeder
{

    private $filesystem;

    public function __construct()
    {
        $this->filesystem = new Filesystem(new Adapter( Storage::disk('uploads')->path('image/jpeg/')));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        for($i=0; $i<10;$i++)
        {
            $filename = UUID::make() . ".jpg";
            $picture = file_get_contents($faker->imageUrl('350', '350'));

            try{

                $this->filesystem->write($filename, $picture);

            } catch (\Exception $e){
                echo $e->getMessage();

                continue;
            }

            $asset = new Asset([
                'title' => $faker->sentence(5),
                'description' => $faker->realText($faker->numberBetween(10,100)),
                'tags' => implode(",", explode(" ", $faker->sentence(5))),
                'file_name' => 'image/jpeg/' . $filename,
                'content' => $faker->realText($faker->numberBetween(1000,5000)),
                'mime_type' => $this->filesystem->getMimetype($filename),
                'size' => $this->filesystem->getSize($filename),
                'creator_id' => 1
            ]);

            $asset->save();

            $categories = Category::all()->random(4);

            $asset->categories()->sync($categories);

            echo "DONE!!\n";
        }




    }
}
