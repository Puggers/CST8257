<html>

<?php
include_once "header.php";
?>

<body>

<?php
include "navbar.php";
?>
<form class="form-horizontal" action="converter.php" method="post">
    <div class="form-group">
        <label for="convertAmount" class="col-sm-2 control-label">Amount</label>

        <div class="col-sm-10">
            <input type="text" class="form-control setWidth" id="convertAmount" name="convertAmount"
                   placeholder="Enter amount here">
        </div>
    </div>
    <div class="form-group">
        <label for="convertUnit" class="col-sm-2 control-label">Unit</label>

        <div class="col-sm-10">
            <select name="convertUnit" id="convertUnit" class="form-control setWidth">
                <option value="noEntry">Select Unit</option>
                <option value="Litres">Litres</option>
                <option value="Gallons">Gallons</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="reset" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-default">Submit</button>
        </div>
    </div>
</form>

</div>

</div>
</div>

</body>


</html>