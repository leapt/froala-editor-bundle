<?php

namespace Leapt\FroalaEditorBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpClient\HttpClient;

class InstallCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('froala:install')
            ->addArgument('path', InputArgument::OPTIONAL, 'Absolute path where to install Froala editor', \dirname(__DIR__) . '/Resources/public/froala_editor')
            ->addOption('tag', null, InputOption::VALUE_REQUIRED, 'Froala editor tag to install (eg. "v4.0.1")', 'master')
            ->addOption('clear', null, InputOption::VALUE_NONE, 'Allow the command to clear a previous install if the path already exists')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $zipPath = $this->downloadZip($output, $input->getOption('tag'));
        $this->extractZip($output, $zipPath, $input->getArgument('path'), $input->getOption('clear'));

        return 0;
    }

    private function downloadZip(OutputInterface $output, string $tag): string
    {
        $output->write('Downloading Froala Editor...');
        $httpClient = HttpClient::create();
        $zip = $httpClient->request('GET', 'https://github.com/froala/wysiwyg-editor/archive/' . $tag . '.zip')->getContent();

        $path = (string) tempnam(sys_get_temp_dir(), 'froala-' . $tag . '.zip');
        if (!@file_put_contents($path, $zip)) {
            throw new \RuntimeException(sprintf('Unable to write Froala ZIP archive to "%s".', $path));
        }

        $output->writeln(' Ok.');

        return $path;
    }

    private function extractZip(OutputInterface $output, string $zipPath, string $outputPath, bool $clear): void
    {
        $output->write('Extracting zip file...');

        $fileSystem = new Filesystem();
        $fileSystem->exists($outputPath);

        if ($fileSystem->exists($outputPath) && !$clear) {
            $output->writeln(sprintf("\nThe directory \"%s\" already exists and the clear option is not enabled, aborting.", $outputPath));
        } else {
            if (is_dir($outputPath)) {
                $fileSystem->remove($outputPath);
            }
            $fileSystem->mkdir($outputPath);

            $zip = new \ZipArchive();
            if (true !== $zip->open($zipPath)) {
                throw new \RuntimeException(sprintf('Cannot open zip file "%s".', $zipPath));
            }
            for ($i = 0; $i < $zip->numFiles; ++$i) {
                $filename = $zip->getNameIndex($i);
                $zipFile = sprintf('zip://%s#%s', $zipPath, $filename);
                // Remove the first directory (eg. "wysiwyg-editor-master") from the file path
                $explodedPath = explode('/', $filename, 2);
                $realFilePath = $explodedPath[1];

                if (str_ends_with($filename, '/')) {
                    $fileSystem->mkdir($outputPath . '/' . $realFilePath);
                } else {
                    copy($zipFile, $outputPath . '/' . $realFilePath);
                }
            }
            $zip->close();

            $output->writeln(' Ok.');
        }
    }
}
