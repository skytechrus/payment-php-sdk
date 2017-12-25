<?php
/**
 * Copyright (c) 2017 Skytech LLC. All rights reserved.
 * Licensed under the MIT license. See LICENSE file in the project root for details.
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

    public function versionPatch()
    {
        $this->taskSemVer('.semver')
            ->increment()
            ->run();
    }

    public function versionMinor()
    {
        $this->taskSemVer('.semver')
            ->increment('minor')
            ->run();
    }

    public function versionMajor()
    {
        $this->taskSemVer('.semver')
            ->increment('major')
            ->run();
    }

    public function versionPrerelease()
    {
        $this->taskSemVer('.semver')
            ->prerelease()
            ->run();
    }

    /*
     * @calls test:all*/
    public function publishDev()
    {
        $this->taskGitStack()
                ->stopOnFail()
                ->push('origin', 'develop')->run();
    }

    public function publishProd()
    {
        $this->taskGitStack()
            ->stopOnFail()
            ->push('origin', 'master')
            ->run();
    }
}
