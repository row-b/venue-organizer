<?php
namespace CoreDomain\ValueObject\Id;

use Ramsey\Uuid\Uuid as RamseyUUid;

class UUId
{
    /**
     * @var string
     */
    private $id;

    public function __construct($id = null)
    {
        if (!$id) {
            $id = RamseyUUid::uuid4()->toString();
        }
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id;
    }
}