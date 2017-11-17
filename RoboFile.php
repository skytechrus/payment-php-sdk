<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 */

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    public function testAll()
    {
        $this->taskCodecept()
            ->suite('unit')
            ->xml()
            ->html()
            ->run();
    }

    public function version()
    {
        $this->taskSemVer('.semver')
            ->increment()
            ->run();
    }

    public function repoDev()
    {
        $this->taskGitStack()
            ->stopOnFail()
            ->push('origin', 'develop')
            ->run();
    }

    public function repoProd()
    {
        $this->taskGitStack()
            ->stopOnFail()
            ->push('origin', 'master')
            ->run();
    }
}
