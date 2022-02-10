<?php
//echo "<pre>";
$limit = 50;
$begin = new DateTime(substr($_GET['from'], 0, 10));
$interval = DateInterval::createFromDateString('1 day');
$end = date_add(new DateTime(substr($_GET['to'], 0, 10)), $interval);
$period = new DatePeriod($begin, $interval, $end);
$timeSpan = [];
foreach ($period as $k => $dt) {
    if (!isset($_GET['from']) && !isset($_GET['to'])) {
        break;
    }
    $timeSpan[$k] = $dt->format("Y-m-d");
}
//var_dump($timeSpan);
//$q = json_decode(file_get_contents("https://data.gov.lv/dati/lv/api/3/action/datastore_search?q={$from}&resource_id=d499d2f0-b1ea-4ba2-9600-2c701b03bd4a&limit={$limit}"));
?>

<form method="get" action="/">
    <input type="datetime-local" name="from" value=""/><input type="datetime-local" name="to"
                                                              value=""/>
    <button type="submit">Submit</button>
</form>

<table border="dotted">
    <thead>
    <th> Date</th>
    <th> Number of tests</th>
    <th> COVID19 positive tests</th>
    <th> Proportion</th>
    </thead>
    <tbody>
    <?php
    foreach ($timeSpan as $date) {
        $q = json_decode(file_get_contents("https://data.gov.lv/dati/lv/api/3/action/datastore_search?q={$date}&resource_id=d499d2f0-b1ea-4ba2-9600-2c701b03bd4a&limit={$limit}"));
        foreach ($q->result->records as $record) {
            $qDate = substr($record->Datums, 0, 10);
            if ($qDate === $date) {
                ?>
                <tr>
                <td> <?php echo $record->Datums; ?> </td>
                <td> <?php echo $record->TestuSkaits; ?> </td>
                <td> <?php echo $record->ApstiprinataCOVID19InfekcijaSkaits; ?> </td>
                <td> <?php echo $record->Ipatsvars; ?> </td>
            <?php } ?>
            </tr>
        <?php }
    } ?>
    </tbody>
</table>
