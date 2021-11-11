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

    /**
     * Get paginated hikyos.
     *
     * @param int $per_page
     * @return Hikyo $hikyos
     */
    public function getPaginatedHikyos(int $per_page)
    {
        return $this->hikyo->paginate($per_page);
    }

    /**
     * Find a hikyo by id
     *
     * @param int $id
     * @return Hikyo $hikyo
     */
    public function findById(int $id)
    {
        return $this->hikyo->find($id);
    }
}
