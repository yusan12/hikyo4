<?php
namespace App\Services;

use Exception;
use App\Repositories\CommentRepository;
use App\Repositories\HikyoRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HikyoService
{
    /**
     * @var CommentRepository
     */
    protected $comment_repository;

    /**
     * @var HikyoRepository
     */
    protected $hikyo_repository;

    /**
     * HikyoService constructor.
     *
     * @param CommentRepository $comment_repository
     * @param HikyoRepository $hikyo_repository
     */
    public function __construct(
        CommentRepository $comment_repository,
        HikyoRepository $hikyo_repository
    ) {
        $this->comment_repository = $comment_repository;
        $this->hikyo_repository = $hikyo_repository;
    }

    /**
     * Create new hikyo and first new comment.
     *
     * @param array $data
     * @return Hikyo $hikyo
     */
    public function createNewHikyo(array $data, string $user_id)
    {
        DB::beginTransaction();
        try {
            $hikyo_data = $this->getHikyoData($data['name'], $user_id, $data{'place'}, $data{'introduction'}, $data{'time_from_tokyo'}, $data{'how_much_from_tokyo'}, $data{'caution'});
            $hikyo = $this->hikyo_repository->create($hikyo_data);

            $comment_data = $this->getCommentData($data['content'], $user_id, $hikyo->id);
            $this->comment_repository->create($comment_data);
        } catch (Exception $error) {
            DB::rollBack();
            Log::error($error->getComment());
            throw new Exception($error->getComment());
        }
        DB::commit();
        return $hikyo;
    }
    /**
     * get hikyo data
     *
     * @param string $hikyo_name
     * @param string $user_id
     * @return array
     */
    public function getHikyoData(string $hikyo_name, string $user_id, string $hikyo_place, string $hikyo_introduction, string $hikyo_time_from_tokyo, string $hikyo_how_much_from_tokyo, string $hikyo_caution)
    {
        return [
            'name' => $hikyo_name,
            'user_id' => $user_id,
            'place' => $hikyo_place,
            'introduction' => $hikyo_introduction,
            'time_from_tokyo' => $hikyo_time_from_tokyo,
            'how_much_from_tokyo' => $hikyo_how_much_from_tokyo,
            'caution' => $hikyo_caution
        ];
    }
    /**
     * get comment data
     *
     * @param string $comment
     * @param string $user_id
     * @param string $hikyo_id
     * @return array
     */
    public function getCommentData(string $comment, string $user_id, string $hikyo_id)
    {
        return [
            'body' => $comment,
            'user_id' => $user_id,
            'hikyo_id' => $hikyo_id
        ];
    }

    /**
     * Get paginated hikyos
     *
     * @param integer $per_page
     * @return Hikyo $hikyos
     */
    public function getHikyos(int $per_page)
    {
        $hikyos = $this->hikyo_repository->getPaginatedHikyos($per_page);
        $hikyos->load('user', 'comments.user');
        return $hikyos;
    }
}
