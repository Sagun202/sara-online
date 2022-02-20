<div id="reviews" class="tab-pane fade" wire:ignore.self>
    <div class="reviews-content-right">
        <h2>Write Your Own Review</h2>
        <form wire:submit.prevent="save">
            <h3>
                You're reviewing: <span>{{ $product->title }}</span>
            </h3>
            <h4>How do you rate this product?<em>*</em></h4>
            <div class="table-responsive reviews-table">
                <table>
                    <tbody>
                        <tr>
                            <th></th>
                            <th>1 star</th>
                            <th>2 stars</th>
                            <th>3 stars</th>
                            <th>4 stars</th>
                            <th>5 stars</th>
                        </tr>
                        <tr>
                            <td>Rating</td>
                            <td>
                                <input type="radio" name="review-star" value="1" wire:model="rate" />
                            </td>
                            <td>
                                <input type="radio" name="review-star" value="2" wire:model="rate" />
                            </td>
                            <td>
                                <input type="radio" name="review-star" value="3" wire:model="rate" />
                            </td>
                            <td>
                                <input type="radio" name="review-star" value="4" wire:model="rate" />
                            </td>
                            <td>
                                <input type="radio" name="review-star" value="5" wire:model="rate" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                @error('rate')
                                <span style="font-size: smaller; color:red;">{{ $message }}</span>
                                @enderror
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-area">
                <div class="form-element">
                    <label>Name <em>*</em></label>
                    <input type="text" wire:model="name" /><br>
                    @error('name')
                    <span style="font-size: smaller; color:red;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-element">
                    <label>Review <em>*</em></label>
                    <textarea wire:model="review"></textarea><br>
                    @error('review')
                    <span style="font-size: smaller; color:red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="buttons-set">
                    <button class="button submit" title="Submit Review" type="submit">
                        <span><i class="fa fa-thumbs-up"></i>
                            &nbsp;Submit</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="reviews-content-left">
        <h2>Customer Reviews</h2>
        @forelse ($reviews as $review)

        <div class="review-ratting">
            <p>
                Review by
                <span class="review-ratting-username">{{ $review->name }}</span>
            </p>
            <table>
                <tbody>
                    <tr>
                        <th>Rating</th>
                        <td>
                            <div class="rating">
                                @for($i=0;$i<$review->rate; $i++)
                                    <i class="fa fa-star"></i>
                                    @endfor
                                    @for($i=0;$i<$review->rate-5;$i++)
                                        <i class="fa fa-star-o"></i>
                                        @endfor
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p class="review-ratting-text">
                {!! $review->review !!}
            </p>
            <p><small> (Posted on {{ date('m/d/Y',strtotime($review->created_at)) }})</small></p>
        </div>
        @empty
        <p>No Reviews Yet!!</p>
        @endforelse

    </div>
</div>