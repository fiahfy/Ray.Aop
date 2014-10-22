<?php
/**
 * This file is part of the Ray.Aop package
 *
 * @license http://opensource.org/licenses/bsd-license.php BSD
 */
namespace Ray\Aop;

use Ray\Aop\Exception\DuplicatedNamedParam;

class NamedArgs implements NamedArgsInterface
{
    /**
     * {@inheritdoc}
     */
    public function get(MethodInvocation $invocation)
    {
        $args = $invocation->getArguments()->getArrayCopy();
        $params = $invocation->getMethod()->getParameters();
        $namedArgs = [];
        foreach ($params as $param) {
            $name = $param->getName();
            if (isset($namedArgs[$name])) {
                throw new DuplicatedNamedParam($name);
            }
            $namedArgs[$param->name] = array_shift($args);
        }

        return $namedArgs;
    }
}
