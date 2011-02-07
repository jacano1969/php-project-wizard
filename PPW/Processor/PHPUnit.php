<?php
/**
 * PHP Project Wizard (PPW)
 *
 * Copyright (c) 2011, Sebastian Bergmann <sb@sebastian-bergmann.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package   PPW
 * @author    Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright 2009-2011 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @since     File available since Release 1.0.2
 */

/**
 * Processor for PHPUnit's XML configuration file.
 *
 * @author    Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @copyright 2011 Sebastian Bergmann <sb@sebastian-bergmann.de>
 * @license   http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @version   Release: @package_version@
 * @link      http://github.com/sebastianbergmann/php-project-wizard/tree
 * @since     Class available since Release 1.0.2
 */
class PPW_Processor_PHPUnit extends PPW_Processor
{
    /**
     * @var string
     */
    protected $bootstrap;

    /**
     * @var string
     */
    protected $tests;

    /**
     * @param string $tests
     */
    public function setTestsFolder($tests)
    {
        $this->tests = $tests;
    }

    /**
     * @param string $bootstrap
     */
    public function setBootstrapFile($bootstrap)
    {
        $this->bootstrap = $bootstrap;
    }

    /**
     */
    public function render()
    {
        $this->template->setVar(
          array(
            'bootstrap' => $this->bootstrap,
            'source'    => $this->getWhitelistXml($this->source),
            'test'      => $this->getTestsuiteXML($this->tests)
          )
        );

        parent::render();
    }

    /**
     * @param  string $tests
     * @return string
     * @since  Method available since Release 1.1.0
     */
    protected function getTestsuiteXML($tests)
    {
        return $this->getXML($tests, 'Test.php');
    }

    /**
     * @param  string $tests
     * @return string
     * @since  Method available since Release 1.1.0
     */
    protected function getWhitelistXml($source)
    {
        return $this->getXML($source, '.php');
    }

    /**
     * @param  string $directories
     * @return string
     * @since  Method available since Release 1.1.0
     */
    protected function getXML($directories, $suffix)
    {
        $directories = explode(',', $directories);
        $xml         = '';

        foreach ($directories as $directory) {
            $xml .= '<directory suffix="' . $suffix . '">' . $directory .
                    "</directory>\n";
        }

        return $xml;
    }
}
