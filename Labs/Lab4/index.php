<!DOCTYPE html>
<html>
<?php
include_once "header.php";
?>

<body>

<?php
include "navbar.php";
?>

        <form action="DepositCalculator.php" method="POST" name="calculator" class="form-horizontal">
          <div class="form-group">
            <label for="pamount" class="col-sm-2 control-label">Principal Amount:</label>
            <div class="col-sm-10">
              <input type="text" name="principalamount" class="form-control textfields" id="pamount">
            </div>
          </div>
          <div class="form-group">
            <label for="irate" class="col-sm-2 control-label">Interest Rate (%):</label>
            <div class="col-sm-10">
              <input type="text" name="interestrate" id="irate" class="form-control textfields">
            </div>
          </div>
          <div class="form-group">
            <label for="years" class="col-sm-2 control-label">Years to Deposit: </label>
            <div class="col-sm-10">
              <select name="years" class="form-control optionbox">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
              </select>
            </div>
          </div>
          <div id="seperator" class="seperator"></div>
          <br>
          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Your Name:</label>
            <div class="col-sm-10">
              <input type="text" name="name" id="name" class="form-control textfields">
            </div>
          </div>
          <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">Your Phone Number:</label>
            <div class="col-sm-10">
              <input type="text" name="phone" id="phone" class="form-control textfields">
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Your Email:</label>
            <div class="col-sm-10">
              <input type="email" name="email" id="email" class="form-control textfields">
            </div>
          </div>
          <div class="form-group">
            <label for="method" class="col-sm-2 control-label">Your Preferred Contact Method:</label>
            <div class="col-sm-10">
              <input type="radio" name="contact" value="Phone">Phone
              <input type="radio" name="contact" value="Email">Email
            </div>
          </div>
          <div class="form-group">
            <label for="check" class="col-sm-2 control-label"> If phone is selected, when can we contact you? (check all applicable)</label>
            <div class="col-sm-10">
              <input type="checkbox" name="time[]" class="box" value="Morning" id="check">Morning
              <br>
              <input type="checkbox" name="time[]" class="box" value="Afternoon">Afternoon
              <br>
              <input type="checkbox" name="time[]" class="box" value="Night">Night
            </div>
          </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default" name="submit" value="Submit">Submit
        </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
