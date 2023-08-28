<?php

namespace App\Http\Controllers\Admin\Chart;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use Carbon\Carbon;
use CyrildeWit\EloquentViewable\Support\Period;
use Illuminate\Validation\ValidationException;

class MeetChartController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function byVisit(Meet $meet)
    {

        $rules['by'] = 'required|in,month,day,week,custom';
        $rules['from-date'] = 'nullable|date_format:Y-m-d';
        $rules['to-date'] = 'nullable|date_format:Y-m-d';
        //validator(request()->all(), $rules)->validate();

        $labels = [];

        $by = request('by');
        $date = now();

        $fromDate = request('from-date');
        $toDate = request('to-date');

        if (request()->has('from-date') && request()->has('to-date')) {
            $by = 'custom';
            $date = Carbon::createFromDate($fromDate);
        }

        switch ($by) {
            case 'custom':
                $days = $date->diffInDays(Carbon::createFromDate($toDate));
                break;
            case 'week':
                $date = $date->startOfYear();
                $days = $date->weeksInYear;
                break;
            case 'month':
                $date = $date->subMonths($date->month - 1);
                $days = 11;
                break;
            default:
                $date = now()->startOfMonth();
                $days = $date->daysInMonth;
                break;
        }

        $datasets = [];
        $datasetsUnique = [];

        for ($i = 0; $i <= $days; $i++) {
            switch ($by) {
                case 'custom':
                    $from = $date->format('Y-m-d H:i');
                    $to = $date->copy()->addDays(1)->format('Y-m-d H:i');
                    $labels[] = $date->toJalali()->format('Y-m-d');
                    break;
                case 'week':
                    $from = $date->format('Y-m-d H:i');
                    $to = $date->copy()->addWeeks(1)->format('Y-m-d H:i');
                    $labels[] = 'هفته '.($i + 1);
                    break;
                case 'month':
                    $from = $date->startOfMonth()->format('Y-m-d H:i');
                    $to = $date->copy()->endOfMonth()->format('Y-m-d H:i');
                    $labels[] = $date->toJalali()->format('M');
                    break;
                default:
                    $days = $date->daysInMonth;
                    $from = $date->format('Y-m-d H:i');
                    $to = $date->copy()->addDays(1)->format('Y-m-d H:i');
                    $labels[] = $date->toJalali()->format('Y-m-d');
                    break;
            }

            $datasets[] = views($meet)->period(Period::create($from, $to))->count();
            $datasetsUnique[] = views($meet)->period(Period::create($from, $to))->unique()->count();

            switch ($by) {
                case 'week':
                    $date->addWeeks();
                    break;
                case 'month':
                    $date->addMonths();
                    break;
                default:
                    $date->addDays();
                    break;
            }

        }

        $response['labels'] = $labels;
        $response['datasets'] = [
            [
                'label' => 'تعداد کل',
                'backgroundColor' => 'transparent',
                'borderColor' => '#6c5ffc',
                'borderWidth' => '3',
                'pointRadius' => '3',
                'data' => $datasets,
            ],
            [
                'label' => 'بازدید یکتا',
                'backgroundColor' => 'transparent',
                'borderColor' => '#05c3fb',
                'borderWidth' => '3',
                'pointRadius' => '3',
                'data' => $datasetsUnique,
            ],
        ];

        return response()->json($response);
    }

    public function byJoin()
    {

    }
}
