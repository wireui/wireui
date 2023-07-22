<?php

namespace Tests\Browser;

use Psy\Command\Command;
use Psy\Formatter\CodeFormatter;
use Psy\Output\ShellOutput;
use ReflectionClass;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/** @see https://github.com/livewire/livewire/blob/master/tests/Browser/DuskCommand.php */
class DuskCommand extends Command
{
    public $e;

    public $testCase;

    public function __construct($testCase, $e, $colorMode = null)
    {
        $this->e = $e;
        $this->testCase = $testCase;

        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('dusk');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = (new ReflectionClass($this->testCase))->getFilename();

        $line = collect($this->e->getTrace())
            ->first(function ($entry) use ($file) {
                return ($entry['file'] ?? '') === $file;
            })['line'];

        $info = [
            'file' => $file,
            'line' => $line,
        ];

        $num = 2;
        $lineNum = $info['line'];
        $startLine = max($lineNum - $num, 1);
        $endLine = $lineNum + $num;
        $code = file_get_contents($info['file']);

        if ($output instanceof ShellOutput) {
            $output->startPaging();
        }

        $output->writeln(sprintf('From <info>%s:%s</info>:', $this->replaceCwd($info['file']), $lineNum));
        $output->write(CodeFormatter::formatCode($code, $startLine, $endLine, $lineNum), false);

        $output->writeln("\n".$this->e->getMessage());

        if ($output instanceof ShellOutput) {
            $output->stopPaging();
        }

        return 0;
    }

    private function replaceCwd($file)
    {
        $cwd = getcwd();

        if ($cwd === false) {
            return $file;
        }

        $cwd = rtrim($cwd, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;

        return preg_replace('/^'.preg_quote($cwd, '/').'/', '', $file);
    }
}
