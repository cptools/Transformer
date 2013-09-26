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
 * @author     Loïc Ambrosini <crazyball@crazyball.fr>
 * @copyright  2013 Loïc Ambrosini <crazyball@crazyball.fr>
 * @license    http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link       http://www.crazyball.fr
 */

namespace CPTools\Transformer;

use CPTools\Transformer\Interfaces\ITransformer;

use ArrayObject;

/**
 * Transformation Scheme Transformer
 * 
 * @category Library
 * @package  Transformer
 * @author   Loïc Ambrosini <crazyball@crazyball.fr>
 * @license  http://www.opensource.org/licenses/bsd-license.php  BSD License
 * @link     http://www.crazyball.fr
 */
class Transformer extends ArrayObject {

    /**
     * Transformers List
     * 
     * @var array
     */
    protected $_transformers = array();

    /**
     * Constructor
     * 
     * @param array $array
     * 
     * @return void
     */
    public function __construct(array $array) {
        parent::__construct($array);
        $this->setFlags(ArrayObject::ARRAY_AS_PROPS);
    }

    /**
     * Return the Transformed Data Table 
     * @return array
     */
    public function transform() {
        $result = $this->getArrayCopy();
        foreach ($this->_transformers as $transformer) {
            $result = $transformer->transform($result);
        }
        return $result;
    }

    /**
     * Add a Data Transformer
     * 
     * @param ITransformer $transformer Transformer to add
     * 
     * @return Container
     */
    public function addTransformer(ITransformer $transformer) {
        $this->_transformers[] = $transformer;
        return $this;
    }

    /**
     * Add many Transformers
     * 
     * @param array $transformers Transformers Array
     * 
     * @return TransformerMap 
     * 
     * @throws \InvalidArgumentException If an array element not instance of ITransformer
     */
    public function addTransformers(array $transformers) {
        foreach ($transformers as $transformer) {
            if (null === $transformer) {
                continue;
            }

            if (!$transformer instanceof ITransformer) {
                throw new InvalidArgumentException("Transformer must implement Transformer Interface");
            }

            $this->_transformers[] = $transformer;
        }
        return $this;
    }

}
