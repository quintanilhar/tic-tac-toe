<?php

namespace Quintanilhar\TicTacToe\Domain;

use InvalidArgumentException;

final class Position
{
    private $row;
    private $column;

    /**
     * @param int $row
     * @param int $column
     */
    public function __construct(int $row, int $column)
    {
        $this->setRow($row);
        $this->setColumn($column);
    }

    /**
     * @param int $row
     * @throws InvalidArgumentException
     */
    private function setRow(int $row)
    {
        if (!$this->isValid($row)) {
            throw new InvalidArgumentException(
                sprintf('Row is invalid (valid options are 0, 1 or 2). Got: %d', $row)
            );
        }

        $this->row = $row;
    }

    /**
     * @param int $column
     * @throws InvalidArgumentException
     */
    private function setColumn(int $column)
    {
        if (!$this->isValid($column)) {
            throw new InvalidArgumentException(
                sprintf('Column is invalid (valid options are 0, 1 or 2). Got: %d', $column)
            );
        }

        $this->column = $column;
    }

    /**
     * @return boolean
     */
    private function isValid(int $position)
    {
        return ($position > -1 && $position < 3);
    }

    /**
     * @return int
     */
    public function row()
    {
        return $this->row;
    }

    /**
     * @return int
     */
    public function column()
    {
        return $this->column;
    }
}
