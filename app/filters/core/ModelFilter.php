<?php
/** @noinspection PhpUnusedParameterInspection */
/** @noinspection PhpUnusedPrivateMethodInspection */
/** @noinspection MissingParameterTypeDeclarationInspection */
/** @noinspection MethodShouldBeFinalInspection */


namespace App\filters\core;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;

abstract class ModelFilter
{
    /**
     * @var Request $request
     * @noinspection VirtualTypeCheckInspection
     */

    protected $request;

    /**
     * Registered filters to operate upon.
     *
     * @var array
     */

    protected $filters = [];
    protected $equal = [];
    protected $dates = [];
    protected $range = [];
    protected $sort = [];
    protected $search = [];
    protected $morphs = [];
    protected $defaults = ['sort', 'range'];
    public $documentation = [];

    /**
     * @param Request $request
     */

    public function __construct(Request $request)
    {
        $this->request = $request;
        if ($this->documentation()){

        }
    }

    public function getRequestAttributes(){

        $out = [];

        foreach ($this->request->all() as $key => $item)
        {
            $t = $key;
            $t = str_replace("-" , "." , $t);
            $out[$t] = $item;
        }

        return $out;

    }

    /**
     * @return null
     */
    public function documentation(){
        return null;
    }

    /**
     * @param Builder $builder
     * @param array $overrides
     * @return Builder
     */
    public function apply(Builder $builder, array $overrides): Builder
    {

        $filters = array_merge($this->filters, $this->equal, $this->defaults);

        foreach ( $filters as $filter) {

            // Run overrides

            $builder = isset($overrides[$filter]) ?
                $this->run($builder, $filter, $overrides[$filter])
                : $builder;

            // Run Request variables
            $request = $this->getRequestAttributes();

            $builder = isset($request[$filter]) ?
                $this->run($builder, $filter, $request[$filter])
                : $builder;
        }

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param string $column
     * @param string $value
     * @return Builder
     */

    private function equal(Builder $builder, string $column, string $value): Builder
    {
        $split = explode('.', $column);

        if (count($split) > 1 )
        {
            [$field, $relationship , $first] = $this->split($split);
            $relation = $builder->getModel()->$first();
            if (get_class($relation) === MorphTo::class )
            {
                return $builder->whereHasMorph($relationship,$this->morphs, function (Builder $builder) use ($value, $field) {
                    $builder->where($field, "=", $value);
                });
            }

            return $builder->whereHas($relationship, function (Builder $builder) use ($value, $field) {
                $builder->where($field, "=", $value);
            });

        }

        return $builder->where($column, "=", $value);
    }

    /**
     * @param Builder $builder
     * @param string $column
     * @param array $value
     * @return Builder
     */
    private function in(Builder $builder, string $column, array $value): Builder
    {
        $split = explode('.', $column);

        if (count($split) > 1) {

            [$field, $relationship] = $this->split($split);

            $relation = $builder->getModel()->$relationship();

            if (get_class($relation) === MorphTo::class ){

                return $builder->whereHasMorph($relationship,$this->morphs, function (Builder $builder) use ($value, $field) {
                    $builder->whereIn($field, "=", $value);
                });

            }

            return $builder->whereHas($relationship, function (Builder $builder) use ($value, $field) {
                $builder->whereIn($field, "=", $value);
            });
        }

        return $builder->whereIn($column, $value);
    }

    /** @noinspection MethodVisibilityInspection */
    /**
     * @param Builder $builder
     * @param $value
     * @return Builder
     */
    protected function search(Builder $builder, $value): Builder
    {
        $builder = $builder->where(function (Builder $builder) use ($value) {

            foreach ($this->search as $column) {

                $split = explode('.', $column);

                if (count($split) > 1) {
                    [$field, $relationship] = $this->split($split);

                    $relation = $builder->getModel()->$relationship();

                    if (get_class($relation) === MorphTo::class ){

                        $builder->orWhereHasMorph($relationship,$this->morphs, function (Builder $builder) use ($value, $field) {
                            $this->andLike($builder, $field, $value);
                        });
                        continue;
                    }

                    $builder->orWhereHas($relationship, function (Builder $builder) use ($value, $field) {
                        $this->andLike($builder, $field, $value);
                    });
                    continue;
                }

                $this->like($builder, $column, $value);
            }

        });

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param string $value
     * @return mixed
     */
    private function range(Builder $builder, string $value): Builder
    {
        // full range=created,45-345
        // $value = created,45-345

        if (is_string($value)) {
            $d = explode(',', $value);
            if (count($d) == 2) {
                $column = $d[0];
                $values = $d[1];
                if (in_array($column, $this->range)) {
                    $values = explode('-', $values);
                    if (count($values) === 2) {
                        $min = trim($values[0]);
                        $max = trim($values[1]);
                        if (in_array($column, $this->dates)) {

                            return $builder->where(function (Builder $builder) use ($column, $min, $max) {
                                if (!empty($min)) {
                                    if (strlen($min) === 8) {
                                        $date = Carbon::createMidnightDate(
                                            substr($min, 0, 4),
                                            substr($min, 4, 2),
                                            substr($min, 6, 2)
                                        );
                                        $builder->where($column, '>=', $date);
                                    }
                                }
                                if (!empty($max)) {
                                    if (strlen($max) === 8) {
                                        $date = Carbon::createMidnightDate(
                                            substr($max, 0, 4),
                                            substr($max, 4, 2),
                                            substr($max, 6, 2)
                                        )->addDay()->subSecond();
                                        $builder->where($column, '<=', $date);
                                    }
                                  }
                            });
                        }

                        return $builder->where(function (Builder $builder) use ($column, $min, $max) {

                            if (!empty($min)) {
                                $builder->where($column, '>=', $min);
                            }

                            if (!empty($max)) {
                                $builder->where($column, '<=', $max);
                            }
                        });
                    }
                }
            }
        }
        return $builder;
    }

    /**
     * @param Builder $builder
     * @param string $value
     * @return Builder
     */

    private function sort(Builder $builder, $value): Builder
    {

        // $value = created_at,desc

        if (is_string($value)) {
            $d = explode(",", $value);
            if (count($d) == 2) {
                return $builder = $builder->orderBy(
                    $d[0],
                    in_array(strtolower($d[1]), ['desc', 'asc']) ? strtolower($d[1]) : 'desc'
                );
            }
        }

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param string $filter
     * @param $value
     * @return Builder
     */

    private function run(Builder $builder, string $filter, $value): Builder
    {
        if ( $value == null
            || empty($value)
            || is_null($value)
            || in_array($filter , [
                'like' , 'in' , 'equal' , 'run' ,'apply'
            ])) {
            return $builder;
        }

        if (in_array($filter, $this->equal)) {
            $builder = is_array($value) ?
                $this->in($builder, $filter, $value) :
                $this->equal($builder, $filter, $value);
        }

        if (method_exists($this, $filter)) {
            $builder = $this->$filter($builder, $value);
        }

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param $column
     * @param $value
     */
    public function like(Builder $builder, $column, $value): void
    {
        $builder->orWhere($column, 'like', "%{$value}%");
    }

    /**
     * @param Builder $builder
     * @param $column
     * @param $value
     */
    public function andLike(Builder $builder, $column, $value): void
    {
        $builder->Where($column, 'like', "%{$value}%");
    }

    /**
     * @param array $split
     * @return array
     */
    private function split(array $split): array
    {
        $field = array_pop($split);
        $relationship = implode(".", $split);
        $key = array_key_first(explode(".",$relationship ));
        $first = explode(".",$relationship )[$key];
//        $first = array_first(explode(".",$relationship ));
        return array( $field, $relationship , $first );
    }
}
