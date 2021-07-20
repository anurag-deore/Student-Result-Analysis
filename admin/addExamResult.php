<?php
include './_header.php';
?>
<div class="container">
    <h3 class="my-3">Add Exam Results</h3>
    <div class="card ">
        <div class="card-body">
            <div class="row">
                <!-- <div class="col-6">
                    <label for="">Select Branch</label>
                    <select class="form-select" aria-label="Default select example" name="branch">
                        <option value="" default>Choose Branch</option>
                        <option value="C">COMPUTER</option>
                        <option value="T">IT</option>
                        <option value="E">ELECTRONICS</option>
                        <option value="X">EXTC</option>
                        <option value="I">INSTRUMENTATION</option>
                    </select>
                </div> -->
                <div class="col-6">
                    <label for="">Select Semester</label>
                    <select class="form-select" aria-label="Default select example" name="sem">
                        <option value="" default>Choose Semester</option>
                        <option value="3">SEMESTER 3</option>
                        <option value="4">SEMESTER 4</option>
                        <option value="5">SEMESTER 5</option>
                        <option value="6">SEMESTER 6</option>
                        <option value="7">SEMESTER 7</option>
                        <option value="8">SEMESTER 8</option>
                    </select>
                </div>
                <div class="col-6">
                    <label for="">Exam Date</label>
                    <input type="month" class="form-control" placeholder="May - 18">
                </div>
            </div>
            <div class=" mt-4">
                <label for="">Upload Result File </label>
                <input type="file" name="" class="form-control" placeholder="Upload Exam Result CSV" id="">
            </div>
            <button class="w-100 btn btn-primary btn-block mt-3">Submit</button>
        </div>
    </div>
</div>
<?php
include './_footer.php';
?>