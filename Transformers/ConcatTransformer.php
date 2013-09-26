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
 * Concat Transformers avaible for concating values
 * 
 * @category Transformer
 * @package  Transformer
 * @author   Loïc Ambrosini <crazyball@crazyball.fr>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link     http://www.crazyball.fr
 */
class ConcatTransformer implements ITransformer {
    
    protected $_destination;
    protected $_keys = array();
    protected $_separator;
    
    /**
     * Constructor
     * 
     * @param array  $keys         Array of Keys to concat
     * @param string $destination  Result Destination Key
     * @param string $separator    Data Separator
     * 
     * @throws InvalidArgumentException Si la destination est nulle/vide
     * 
     * @return void
     */
    public function __construct(array $keys, $destination, $separator = null) {
        if (null === $destination || empty($destination)) {
            throw new InvalidArgumentException ('Destination cannot be null or empty');
        }
        
        $this->_keys        = $keys;
        $this->_destination = $destination;
        $this->_separator   = $separator;
    }
    
    /**
     * Return Transformed Data Array 
     * 
     * @param array $data Input Datas
     * @throws InvalidArgumentException If a key doesnt exist
     * 
     * @return array Output Datas
     */
    public function transform(array $data) {
        $concat = array();
        foreach ($this->_keys as $key) {
            if (!array_key_exists($key, $data)) {
                throw new InvalidArgumentException("Key '$key' does not exist");
            }
            array_push($concat, $data[$key]);
        }
        $data[$this->_destination] = implode($this->_separator, $concat);
        return $data;
    }

}
