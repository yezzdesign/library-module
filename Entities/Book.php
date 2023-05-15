<?php

namespace Modules\Library\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Book extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected static array $readComplete    =   array();
    protected static array $readIncomplete  =   array();

    protected $fillable = ['title', 'read_date', 'active_state', 'author', 'pages', 'blurb', 'genre', 'publisher'];

    protected static function newFactory(){
        return \Modules\Library\Database\factories\BookFactory::new();
    }

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('thumb')
            ->performOnCollections('book_cover')
            ->crop('crop-center', 40, 60)
            ->nonQueued();

        $this->addMediaConversion('larger')
            ->performOnCollections('book_cover')
            ->crop('crop-center', 400, 600)
            ->nonQueued();
    }

    public static function getIndexTableData() {
        return self::orderBy('id', 'desc')->paginate(25);
    }

    public function links(): hasMany
    {
        return $this->hasMany(Booklink::class );
    }

    public static function getAllReadedBooksSorted() : array {
        // get all Items that are active
        $booklists = self::where('active_state', 1)->orderByDesc('read_date')->get();

        foreach ($booklists as $booklist) {
            if (!empty($booklist->read_date)) {
                $year   =   \Carbon\Carbon::parse($booklist->read_date)->format('Y');
                $month  =   \Carbon\Carbon::parse($booklist->read_date)->translatedFormat('F');

                self::$readComplete[$year][$month][] =   $booklist;
            }
        }
        return self::$readComplete;
    }

    public static function getAllUnreadedBooksSorted() : array {

        // get all Items that are active
        $booklists = self::all()->where('active_state', 1)->sortByDesc('id');

        foreach ($booklists as $booklist) {
            if (empty($booklist->read_date))
                self::$readIncomplete[] =   $booklist;
        }
        return self::$readIncomplete;
    }
}
