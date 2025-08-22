<?php

namespace App\Command;

use App\Entity\Post;
use App\Repository\CategoryRepository;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:calculate-posts-in-category',
    description: 'Calculate and cache count posts in category.',
)]
class CalculatePostsInCategoryCommand extends Command
{
    /**
     * @param CategoryRepository $categoryRepository
     * @param PostRepository $postRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        private CategoryRepository     $categoryRepository,
        private PostRepository         $postRepository,
        private EntityManagerInterface $entityManager
    )
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        // $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        foreach ($this->categoryRepository->findAll() as $category) {
            $cacheCountPosts = $this->postRepository->countPublishedBy($category);
            $category->setCacheCountPosts($cacheCountPosts);
            $this->entityManager->persist($category);

            $io->writeln(sprintf(
                'Category "%s" with %s posts.', $category->getTitle(), $category->getCacheCountPosts()
            ));
        }

        $this->entityManager->flush();

        $io->info('All information was saved successful!');

        return Command::SUCCESS;
    }
}
