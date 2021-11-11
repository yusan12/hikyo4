<?php
namespace App\Repositories;
use App\Hikyo;
class HikyoRepository
{
    /**
     * @var Hikyo
     */
    protected $hikyo;
    /**
     * HikyoRepository constructor.
     *
     * @param Hikyo $hikyo
     */
    public function __construct(Hikyo $hikyo)
    {
        $this->hikyo = $hikyo;
    }
    /**
     * Create new Hikyo.
     *
     * @param array $data
     * @return Hikyo $hikyo
     */
    public function create(array $data)
    {
        return $this->hikyo->create($data);
    }
}
