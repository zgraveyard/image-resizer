<?php namespace Resizer\Commands;

use Resizer\Classes\Resize;
use Resizer\Contracts\ResizeInterface;
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
            $item->images = $this->resize(new Resize, $item);
            $item->processed = true;
            $item->save();
            $progress->advance();
        });


        $progress->finish();
    }

    protected function resize(ResizeInterface $resize, $item)
    {
        return json_encode($resize->resizeImage($item->original));
    }

}