<?php namespace Resizer\Commands;

use Resizer\Classes\Resize;
use Resizer\Models\Image;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ProcessCommand extends Command
{

    public function configure()
    {
        $this->setName('process')
            ->setDescription('This command will get the images and process them');
    }


    public function execute(InputInterface $input, OutputInterface $output)
    {
        $test = (new Image)->active();

        if($test->count() === 0)
        {
            $output->writeln('<info>Nothing to process.</info>');
            exit;
        }

        $progress = new ProgressBar($output, $test->count());
        $progress->start();

        $test->each(function($item) use($progress){
            $item->images = json_encode((new Resize)->resizeImage($item->original));
            $item->processed = true;
            $item->save();
            $progress->advance();
        });


        $progress->finish();


        //var_dump($test);
        //$output->writeln('<info>'.env('DB_PORT','10').'</info>');
    }

}