<?php
namespace App\Repositories;
use App\Comment;
class CommentRepository
{
    /**
     * @var Comment
     */
    protected $comment;
    /**
     * CommentRepository constructor.
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    /**
     * Create new Comment.
     *
     * @param array $data
     * @return Comment $comment
     */
    public function create(array $data)
    {
        return $this->comment->create($data);
    }
}
