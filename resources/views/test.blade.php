
@extends('layouts.back')
 
 @section('content')

<?php

?>

						<div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tests</h6>
                                </div>
                                <div class="card-body">
								<?php echo  json_encode($result, JSON_PRETTY_PRINT); ?>
                                </div>
                            </div>

                       

                        </div>
 
                    </div>

@endsection
