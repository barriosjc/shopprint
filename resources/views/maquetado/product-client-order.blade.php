@extends('profile.main')

@section('p-content')
    <section class="col-lg-12">
        <!-- Toolbar-->
        {{-- <div class="d-flex justify-content-between align-items-center pt-lg-2 pb-4 pb-lg-5 mb-lg-3">
      <div class="d-flex align-items-center">
        <label class="d-none d-lg-block fs-sm text-light text-nowrap opacity-75 me-2" for="order-sort">Sort orders:</label>
        <label class="d-lg-none fs-sm text-nowrap opacity-75 me-2" for="order-sort">Sort orders:</label>
        <select class="form-select" id="order-sort">
          <option>All</option>
          <option>Delivered</option>
          <option>In Progress</option>
          <option>Delayed</option>
          <option>Canceled</option>
        </select>
      </div><a class="btn btn-primary btn-sm d-none d-lg-inline-block" href="account-signin.html"><i class="ci-sign-out me-2"></i>Sign out</a>
    </div> --}}
        <!-- Orders list-->
        <!-- Light table with striped rows -->
        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Product #</th>
                                        
										<th>Product Name</th>
										<th>Date</th>
                                        <th>Status</th>
									    <th>Total</th>
										<th>Files</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr style="vertical-align: middle;">
                                            <td>P01-70210</td>
                                            
											<td>RIGID</td>
											<td>11-09-23</td>
                                            <td><span class="badge bg-info m-0">In Review</span>
                                                   
											
											
											</td>
											<td>U$S 3,225.54</td>
											<td><a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-eye"></i> </a>
												<a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-message"></i> </a>
											</td>
                                            
                                        </tr>
									<tr style="vertical-align: middle;">
                                            <td>P01-70210</td>
                                            
											<td>RIGID</td>
											<td>11-09-23</td>
                                            <td><span class="badge bg-success m-0">Aprovved</span> 
                                                   
											
											
											</td>
										<td>U$S 3,225.54</td>
											<td><a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-eye"></i> </a>
											
												<a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-message"></i> <span class="badge rounded-pill bg-danger">2</span></a>
												
									  </td>
                                            
                                  </tr>
									<tr style="vertical-align: middle;">
                                            <td>P01-70210</td>
                                            
											<td>RIGID</td>
											<td>11-09-23</td>
                                            <td><span class="badge bg-danger m-0">Refused</span>
                                                    
											
											
											</td>
										<td>U$S 3,225.54</td>
											<td><a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-eye"></i> </a>
											
												<a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-message"></i> </a>
											</td>
                                            
                                  </tr>
									<tr style="vertical-align: middle;">
                                            <td>P01-70210</td>
                                            
											<td>RIGID</td>
											<td>11-09-23</td>
                                            <td><span class="badge bg-info m-0">In Review</span> 
                                                   
											
											
											</td>
										<td>U$S 3,225.54</td>
											<td><a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-eye"></i> </a>
											
												<a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-message"></i> </a>
											</td>
                                            
                                  </tr>
                                </tbody>
                            </table>
                        </div>

    </section>
@endsection
