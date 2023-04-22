<?php

function defer(?SplStack &$context, callable $callback): void
{
    $context ??= new class() extends SplStack {
        public function __destruct()
        {
            while ($this->count() > 0) {
                \call_user_func($this->pop());
            }
        }
    };

    $context->push($callback);
}
