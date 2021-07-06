<style>
legend {
    background-color: #000;
    color: #fff;
    padding: 3px 6px;
}

fieldset{
    width:50%;
}
</style>


<form>
<fieldset>
    <legend>Choose your favorite monster</legend>

<div class="form-example">
<br>
<label for="identifiant">Identifier (<span style=color:red;>*</span>):
<input type="number" id="identifiant" name="identifier" placeholder="Identifier"></label><br><br>
</div>
<label for="fname">First Name (<span style=color:red;>*</span>):
<input type="text" id="fname" name="fname" placeholder="First Name"></label><br><br>

<label for="lname">Last Name (<span style=color:red;>*</span>):
<input type="text" id="lname" name="lname" placeholder="Last Name"></label><br><br>

<label for="birth">Birth Date (<span style=color:red;>*</span>):
<input type="date" id="birth" name="birth"></label><br><br>

<label for="address">Address:
<input type="text" id="address" name="address" placeholder="Address"></label><br><br>

<label for="phone">Phone (<span style=color:red;>*</span>):
<input type="number" id="phone" name="phone" placeholder="Phone"></label><br><br>
</fieldset>
</form>


