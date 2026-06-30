<div class="container">
    <div class="dashboard rounded-3 bg-white p-md-5 p-3">
        <div class="row">
            <div class="col-md-3 border-end pe-md-4">
                <div class="profile_detail mb-md-4 mb-3">
                    <h1>{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h1>
                    <address class="small_font">{{ $data['address'] }}</address>
                </div>
                <div class="skill mb-md-4 mb-3">
                    <div class="d-flex justify-content-between border-bottom">
                        <h2>Skills</h2>
                        <a data-bs-toggle="modal" href="#skillpopup" role="button"><i
                                class="fas fa-pencil"></i></a>
                    </div>
                    <ul class="list-unstyled mt-3">
                        <li class="small_font pb-2">HTML</li>
                        <li class="small_font pb-2">CSS</li>
                        <li class="small_font pb-2">javascript</li>
                        <li class="small_font pb-2">bootstrap</li>
                    </ul>
                </div>
                <div class="english_preferance mb-md-4 mb-3">
                    <div class="d-flex justify-content-between border-bottom">
                        <h2>English Preferance</h2>
                        <a  wire:click="showEnglishPreference" role="button"><i
                                class="fas fa-pencil"></i></a>
                    </div>
                    <p class="small_font mt-3">{{ $data['english_fluency'] }}</p>
                </div>
                <div class="availibility mb-md-4 mb-3">
                    <div class="d-flex justify-content-between border-bottom">
                        <h2>Availibility</h2>
                        <a data-bs-toggle="modal" href="#availibilitypopup" role="button"><i
                                class="fas fa-pencil"></i></a>
                    </div>
                    <p class="small_font mt-3">{{ $data['availability'] }}</p>
                </div>
                <div class="linkedin_profile mb-md-4 mb-3">
                    <div class="d-flex justify-content-between border-bottom">
                        <h2>Linkedin Profile</h2>
                        <a data-bs-toggle="modal" href="#linkedinpopup" role="button"><i
                                class="fas fa-pencil"></i></a>
                    </div>
                    <a class="small_font mt-3" href="{{ $data['linkedin_link'] }}" target="_blank">{{ $data['linkedin_link'] }}</a>
                </div>
                <div class="github_profile mb-md-4 mb-3">
                    <div class="d-flex justify-content-between border-bottom">
                        <h2>Github Profile</h2>
                        <a data-bs-toggle="modal" href="#githubpopup" role="button"><i
                                class="fas fa-pencil"></i></a>
                    </div>
                    <a class="small_font mt-3" href="{{ $data['github_link'] }}" target="_blank">{{ $data['github_link'] }}</a>
                </div>
            </div>
            <div class="col-md-9 ps-md-4">
                <div class="row mb-3">
                    <div class="col-11">
                        <h2>{{ $data['designation']['title'] }}</h2>
                    </div>
                    <div class="col-1 text-end">
                        <a data-bs-toggle="modal" href="#jobtitlepopup" role="button"><i
                                class="fas fa-pencil"></i></a>
                    </div>
                </div>
                <div class="row border-bottom pb-4 mb-4">
                    <div class="col-11">
                        <p class="small_font mb-0">{{ $data['about_self'] }}</p>
                    </div>
                    <div class="col-1 text-end">
                        <a data-bs-toggle="modal" href="#aboutpopup" role="button"><i
                                class="fas fa-pencil"></i></a>
                    </div>
                </div>
                @if($data['work_experience'])
                @foreach($data['work_experience'] as $workExperience)
                <div class="border-bottom mb-4 pb-4">
                    <h2 class="mb-4">Work Experience</h2>
                    <div class="row mb-3">
                        <div class="col-11">
                            <h4 class="mb-0">{{ $workExperience['role'] }}</h4>
                        </div>
                        <div class="col-1 text-end">
                            <a data-bs-toggle="modal" href="#rolepopup" role="button"><i
                                    class="fas fa-pencil"></i></a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-11">
                            <h5 class="mb-0">{{ $workExperience['project_link'] }}</h5>
                        </div>
                        <div class="col-1 text-end">
                            <a data-bs-toggle="modal" href="#linkpopup" role="button"><i
                                    class="fas fa-pencil"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-11">
                            <p class="small_font mb-0">{{ $workExperience['responsibilities'] }}</p>
                        </div>
                        <div class="col-1 text-end">
                            <a data-bs-toggle="modal" href="#responsibilitypopup" role="button"><i
                                    class="fas fa-pencil"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                <div class="portfolio">
                    <div class="row mb-md-4 mb-3">
                        <div class="col-11">
                            <h2 class="mb-0">Portfolio</h2>
                        </div>
                        <div class="col-1 text-end">
                            <a data-bs-toggle="modal" href="#projectaddpopup" role="button"><i class="fas fa-plus-circle text-primary"></i></a>
                        </div>
                    </div>
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="0" class="active" aria-current="true"
                                aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="d-flex">
                                    <div class="portfolio_slider p-3 rounded-2 position-relative text-center">
                                        <img src="images/portfolio_1.png" alt="portfolio_1" class="img-fluid">
                                        <p class="mt-3">Project 1</p>
                                        <div class="edit_profile">
                                            <a data-bs-toggle="modal" href="#singleprojectaddpopup" role="button"><i
                                                class="fas fa-pencil"></i></a>
                                        </div>
                                    </div>
                                    <div class="portfolio_slider p-3 rounded-2 position-relative text-center">
                                        <img src="images/portfolio_2.png" alt="portfolio_1" class="img-fluid">
                                        <p class="mt-3">Project 1</p>
                                        <div class="edit_profile">
                                            <a data-bs-toggle="modal" href="#singleprojectaddpopup" role="button"><i
                                                class="fas fa-pencil"></i></a>
                                        </div>
                                    </div>
                                    <div class="portfolio_slider p-3 rounded-2 position-relative text-center">
                                        <img src="images/portfolio_1.png" alt="portfolio_1" class="img-fluid">
                                        <p class="mt-3">Project 1</p>
                                        <div class="edit_profile">
                                            <a data-bs-toggle="modal" href="#singleprojectaddpopup" role="button"><i
                                                class="fas fa-pencil"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <div class="d-flex">
                                    <div class="portfolio_slider p-3 rounded-2 position-relative text-center">
                                        <img src="images/portfolio_1.png" alt="portfolio_1" class="img-fluid">
                                        <p class="mt-3">Project 1</p>
                                        <div class="edit_profile">
                                            <a data-bs-toggle="modal" href="#singleprojectaddpopup" role="button"><i
                                                class="fas fa-pencil"></i></a>
                                        </div>
                                    </div>
                                    <div class="portfolio_slider p-3 rounded-2 position-relative text-center">
                                        <img src="images/portfolio_2.png" alt="portfolio_1" class="img-fluid">
                                        <p class="mt-3">Project 1</p>
                                        <div class="edit_profile">
                                            <a data-bs-toggle="modal" href="#singleprojectaddpopup" role="button"><i
                                                class="fas fa-pencil"></i></a>
                                        </div>
                                    </div>
                                    <div class="portfolio_slider p-3 rounded-2 position-relative text-center">
                                        <img src="images/portfolio_1.png" alt="portfolio_1" class="img-fluid">
                                        <p class="mt-3">Project 1</p>
                                        <div class="edit_profile">
                                            <a data-bs-toggle="modal" href="#singleprojectaddpopup" role="button"><i
                                                class="fas fa-pencil"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Skills popup model -->
    <div class="modal fade" id="skillpopup" aria-hidden="true" aria-labelledby="skillpopupLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pb-2">
                    <h4 class="modal-title" id="exampleModalToggleLabel">Skills</h4>
                    <button type="button" class="btn-close py-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-lg-5 mb-md-4 mb-3">
                        <select class="form-select border-0 border-bottom rounded-0 ps-1" aria-label="Default select example">
                            <option selected>Skills</option>
                            <option value="1">Html5</option>
                            <option value="2">CSS</option>
                            <option value="3">PHP</option>
                        </select>
                    </div>
                    <div class="mt-4">
                        <a wire:click="submitSkill()" class="btn btn-primary text-white">Submit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($showEnglishPreferenceModal)
    <!-- English Preferance popup model -->
    <div class="modal fade" aria-hidden="true" aria-labelledby="englishpopupLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header pb-2">
                    <h4 class="modal-title" id="exampleModalToggleLabel">English Preferance</h4>
                    <button type="button" class="btn-close py-0" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex">
                        <div class="form-check me-3">
                            <input class="form-check-input" wire:model="temp.english_fluency" value="Beginner" type="radio">
                            <label class="form-check-label">
                                Beginner
                            </label>
                        </div>
                        <div class="form-check me-3">
                            <input class="form-check-input" wire:model="temp.english_fluency" value="Intermediate" type="radio">
                            <label class="form-check-label">
                                Intermediate
                            </label>
                        </div>
                        <div class="form-check me-3">
                            <input class="form-check-input" wire:model="temp.english_fluency" value="Fluent" type="radio">
                            <label class="form-check-label">
                                Fluent
                            </label>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a wire:click="submitEnglishPreference" class="btn btn-primary text-white">Submit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>