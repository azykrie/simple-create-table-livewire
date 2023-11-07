<div>
    <div class="container py-5">
        <div class="row g-2">
            <div class="col-8">
                <div class="p-3 border bg-light">
                    <nav class="navbar bg-light">
                        <div class="container-fluid">
                            <input wire:model.live='search' class="form-control me-2" type="search" placeholder="Search"
                                aria-label="Search">
                        </div>
                    </nav>
                    @if (session('success'))
                        <span class="text-success">{{ session('success') }}</span>
                    @endif
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($users as $user)
                            <tbody>
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <button wire:confirm="Are you sure you want to delete this post?"
                                            wire:click='delete({{ $user->id }})'
                                            class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
            <div class="col-4">
                <div class="p-3 border bg-light">
                    <form wire:submit='create'>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input wire:model='name' type="text" class="form-control" id="exampleFormControlInput1"
                                placeholder="you name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input wire:model='email' type="email" class="form-control" id="exampleFormControlInput1"
                                placeholder="name@example.com">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Password</label>
                            <input wire:model='password' type="password" class="form-control"
                                id="exampleFormControlInput1" placeholder="">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Profile picture</label>
                            <input wire:model='image' class="form-control" accept="image/png , image/jpeg"
                                type="file" id="formFile">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            @if ($image)
                                <img src="{{ $image->temporaryUrl() }}" class="rounded float-left mb-3" alt="..."
                                    width="150" height="100">
                            @endif
                        </div>
                        <div wire:loading wire:target='image'>
                            <span class="text-success">Uploading...</span>
                        </div>
                        <div wire:loading wire:target='create'>
                            <span class="text-success">Sending...</span>
                        </div>
                        <button wire:loading.remove type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
