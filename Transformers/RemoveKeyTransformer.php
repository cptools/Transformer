<?php

/**
 * CTransformer
 *
 * Copyright (c) 2013, Loïc Ambrosini <crazyball@crazyball.fr>.
 * All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
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
 * PHP Version 5.4
 * 
 * @category   Utilities
 * @package    Transformer
 * @subpackage Transformers
 * @author     Loïc Ambrosini <crazyball@crazyball.fr>
 * @copyright  2013 Loïc Ambrosini <crazyball@crazyball.fr>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link       http://www.crazyball.fr
 */
namespace CPTools\Transformer\Transformers;

use CPTools\Transformer\Interfaces\ITransformer;

/**
 * Remove Key Transformers avaible for concating values
 * 
 * @category Transformer
 * @package  Transformer
 * @author   Loïc Ambrosini <crazyball@crazyball.fr>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link     http://www.crazyball.fr
 */
class RemoveKeyTransformer implements ITransformer {
    
    protected $_keyName;
    
    /**
     * 
     * @param string $keyName Key to remove from datatable
     * @throws InvalidArgumentException if key is NULL
     * 
     * @return void
     */
    public function __construct($keyName) {
        if (null === $keyName || empty($keyName)) {
            throw new InvalidArgumentException(
                '$keyName cannot be null or empty'
            );
        }
        $this->_keyName = $keyName;
    }
    
    /**
     * Return Datatable with updated data
     * 
     * @param array $data Input data
     * 
     * @return array Output data
     */
    public function transform(array $data) {
        if (array_key_exists($this->_keyName, $data)) {
            unset($data[$this->_keyName]);
        }
        return $data;
    }
}
