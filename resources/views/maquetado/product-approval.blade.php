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
                                        
										<th>Description</th>
										<th>Files</th>
										<th>Messages</th>
										<th>Quantity</th>
                                        <th>Date</th>
									    <th>Status</th>
									</tr>
                                </thead>
                                <tbody>
                                        <tr style="vertical-align: middle;">
                                            <td valign="top"><strong>P01-70210</strong></td>
                                            
											<td valign="top"><p><strong>Product name:</strong> BANNER / VINYL</p>
										    <p><strong>Weight:</strong> 13 OZ.</p>
										    <p><strong>SIZE:<br>
										    Width:</strong> 11 feet, 3 inches <br>
										    <strong>Height:</strong> 10 feet, 5 inches </p>
										    <p><strong>Welding:</strong> Top</p>
										    <p><strong>Grommets:</strong> Every 24&rdquo;</p>
										    <p><strong>Rope:</strong> No Rope</p>
										    <p><strong>Pole Pocket:</strong> Top Only</p>
										    <p><strong>Pole Pocket Size:</strong> 2&rdquo; for 1&rdquo; Pole</p>
										    <p><strong>Shop name:</strong> MYSHO897</p>
										    <p><strong>PO Number:</strong> AZ90O897</p></td>
											<td valign="top">
												<p><strong>PRINT FILE:</strong></p>
											  <a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-edit-alt"></i> </a>
												
											<a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-download"></i> </a>
												<a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-trash"></i> </a>
												<br><br>


												<p><strong>CUT FILE:</strong></p>
											  <a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-edit-alt "></i> </a>
												
											<a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-download"></i> </a>
												<a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-trash"></i> </a>
												
											
										  </td>
											<td valign="top"><a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-message"></i> <span class="badge rounded-pill bg-danger">2</span></a></td>
											<td valign="top">250 U.</td>
                                            <td valign="top">11-09-23</td>
											<td valign="top"><span class="badge bg-info m-0">In Review</span>
                                                    <a class="btn btn-sm-80 btn-secondary btn-icon" href="#"><i class="text-body ci-edit-alt size-icon"></i> </a>
											
											
										  </td>
										</tr>
                                </tbody>
                            </table>
                        </div>

    </section>
@endsection
