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
            <section class="col-lg-12">
                <!-- Toolbar-->

                <!-- Ticket details (visible on mobile)-->

                <!-- Comment-->
                <div class="d-flex align-items-start pb-4 border-bottom"><img class="rounded-circle"
                        src="img/testimonials/03.jpg" width="50" alt="Michael Davis">
                    <div class="ps-3">
                        <h6 class="fs-md mb-2">Michael Davis</h6>
                        <p class="fs-md mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                            ullamco laboris nisi ut aliquip ex ea commodo consequat cupidatat non proident, sunt in culpa
                            qui.</p><span class="fs-ms text-muted"><i class="ci-time align-middle me-2"></i>Sep 30, 2019 at
                            11:05AM</span>
                    </div>
                </div>
                <!-- Comment reply-->
                <div class="d-flex align-items-start py-4 border-bottom"><img class="rounded-circle"
                        src="img/testimonials/03.jpg" width="50" alt="Michael Davis">
                    <div class="ps-3">
                        <h6 class="fs-md mb-2">Michael Davis</h6>
                        <p class="fs-md mb-1">Sed elementum tempus egestas sed sed. Aliquam faucibus purus in massa tempor
                            nec feugiat. Interdum varius sit amet mattis. Magna ac placerat vestibulum lectus mauris. Magna
                            fringilla urna porttitor rhoncus dolor purus non. Urna et pharetra pharetra massa massa
                            ultricies mi quis.</p><span class="fs-ms text-muted"><i
                                class="ci-time align-middle me-2"></i>Sep 28, 2019 at 10:00AM</span>
                        <!-- Comment-->
                        <div class="d-flex align-items-start border-top pt-4 mt-4"><img class="rounded-circle"
                                src="img/testimonials/04.jpg" width="50" alt="Susan Gardner">
                            <div class="ps-3">
                                <h6 class="fs-md mb-2">Susan Gardner</h6>
                                <p class="fs-md mb-1">Egestas sed sed risus pretium quam vulputate dignissim. A diam
                                    sollicitudin tempor id eu nisl. Ut porttitor leo a diam. Bibendum at varius vel pharetra
                                    vel turpis nunc.</p><span class="fs-ms text-muted"><i
                                        class="ci-time align-middle me-2"></i>Sep 27, 2019 at 6:30PM</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Leave message-->
                <h3 class="h5 mt-2 pt-4 pb-2">Leave a Message</h3>
                <form class="needs-validation" novalidate>
                    <div class="mb-3">
                        <textarea class="form-control" rows="8" placeholder="Write your message here..." required></textarea>
                        <div class="invalid-tooltip">Please write the message!</div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                        <div class="form-check">

                        </div>
                        <button class="btn btn-primary my-2" type="submit">Submit message</button>
                    </div>
                </form>
            </section>
        </div>

    </section>
@endsection
