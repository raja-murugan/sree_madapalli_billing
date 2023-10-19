<div class="card-body">
    <form autocomplete="off" method="POST" action="{{ route('manager.invite.store') }}">
        @csrf
        <div class="row">
            <div class="col-lg-12 col-sm-6 col-12">
                <div class="form-group">
                    <label>Name <span style="color: red;">*</span></label>
                    <input type="text" name="name" placeholder="Enter manager name" required>
                </div>
            </div>
            <div class="col-lg-12 col-sm-6 col-12">
                <div class="form-group">
                    <label>Email Address <span style="color: red;">*</span></label>
                    <input type="text" name="email" placeholder="Enter manager email address" required>
                </div>
            </div>
            <div class="col-lg-12 col-sm-6 col-12">
                <div class="form-group">
                    <label>Conatct Number <span style="color: red;">*</span></label>
                    <input type="text" name="contact_number" placeholder="Enter manager conatct number" required>
                </div>
            </div>
            <div class="col-lg-12 col-sm-6 col-12">
                <div class="form-group">
                    <label>Role <span style="color: red;">*</span></label>
                    <select class="select" name="role_id" required>
                        <option value="" disabled selected hidden>
                            Choose Role</option>
                        @foreach ($role as $roles)
                            <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr>
            <div class="col-lg-12 button-align">
                <button type="submit" class="btn btn-submit me-2">Send Invite</button>
            </div>
        </div>
    </form>
</div>
