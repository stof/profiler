<?php
/**
 * This file is for displaying db profiler result.
 */


class okvpDisplayProfilerDb
{


    public function display()
    {
        list($profiler, $dbh, $data_values) = func_get_args();

        if (is_array($data_values)) {
            if (array_key_exists('time_start', $data_values) && array_key_exists('time_end', $data_values)) {
                echo '<div class="okvprofiler-log-db-timetake">'."\n";
                echo $profiler->getReadableTime(($data_values['time_end']-$data_values['time_start'])*1000);
                echo '</div>'."\n";
            }
            if (array_key_exists('memory', $data_values)) {
                echo '<div class="okvprofiler-log-memory">';
                if (isset($number)) {
                    echo $number->fromBytes($data_values['memory']);
                } else {
                    echo $profiler->getReadableFileSize($data_values['memory']);
                }
                echo '</div>'."\n";
            }
        }

        $sth = okvpDbQuery($dbh, 'EXPLAIN '.$data_values['data']);
        if ($sth) {
            echo '<div class="okvprofiler-log-newrow">'."\n";
            echo '<div class="okvprofiler-log-db-explain">'."\n";
            $results = $sth->fetchObject();
            if ($results) {
                foreach ($results as $key => $val) {
                    echo $key . ' = ' . $val;
                    if (end($results) != $val) {
                        echo ', ';
                    }
                }
            }
            unset($key, $results, $val);
            echo '</div>'."\n";
            echo '</div>'."\n";
        }

        if (is_array($data_values) && array_key_exists('call_trace', $data_values)) {
            echo '<div class="okvprofiler-log-newrow">'."\n";
            echo '<div class="okvprofiler-log-db-trace">'."\n";
            echo '<strong>Call trace:</strong><br>'."\n";
            foreach ($data_values['call_trace'] as $trace_item) {
                echo $trace_item['file'].', line '.$trace_item['line'].'<br>'."\n";
            }
            unset($trace_item);
            echo '</div>'."\n";
            echo '</div>'."\n";
        }

        unset($data_values, $dbh, $profiler, $sth);
    }// display


}