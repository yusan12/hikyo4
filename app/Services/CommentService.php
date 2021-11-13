<?php
namespace App\Services;
use Exception;
use App\Repositories\HikyoRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class CommentService
{
    /**
     * @var HikyoRepository
     */
    protected $hikyo_repository;
    /**
     * HikyoService constructor.
     *
     * @param HikyoRepository $hikyo_repository
     */
    public function __construct(
        HikyoRepository $hikyo_repository
    ) {
        $this->hikyo_repository = $hikyo_repository;
    }

    /**
     * Create new comment and first new comment.
     *
     * @param array $data
     * @return Hikyo $hikyo
     */
    public function createNewComment(array $data, string $hikyo_id)
    {
        DB::beginTransaction();
        try {
            $hikyo = $this->hikyo_repository->findById($hikyo_id);
            $comment = $hikyo->comments()->create($data);
        } catch (Exception $error) {
            DB::rollBack();
            Log::error($error->getComment());
            throw new Exception($error->getComment());
        }
        DB::commit();
        return $comment;
    }

    /**
     * Convert link from comment
     *
     * @param string $comment
     * @return string $comment
     */
    public function convertUrl(string $comment)
    {
        $comment = e($comment);
        $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
        $replace = '<a href="$1" target="_blank">$1</a>';
        $comment = preg_replace($pattern, $replace, $comment);
        return $comment;
    }
}
