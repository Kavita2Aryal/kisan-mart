<div class="row m-t-15 list-item">
    <div class="col-md-12">
        <div class="card bg-contrast-lower m-b-0">
            <div class="card-body p-b-5">
                <div class="row">
                    <strong class="col-md-12">
                        Head Configuration:
                        @if ($count > 1)
                        <button type="button" class="btn btn-link text-danger pull-right btn-remove-list">REMOVE</button>
                        @endif
                    </strong>
                </div>
                @php $item = 'title'; @endphp
                <div class="form-group row">
                    <label class="col-md-5 control-label p-t-0">{{ ucwords($item) }}</label>
                    <div class="col-md-7 text-right">
                        <div class="form-check m-b-0 form-check-inline success">
                            <input type="radio" 
                                value="1" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][head][{{ $item }}]" 
                                id="yes-{{ $indexing }}-{{ $count }}-head-{{ $item }}"
                            />
                            <label for="yes-{{ $indexing }}-{{ $count }}-head-{{ $item }}">YES</label>
                        </div>
                        <div class="form-check m-b-0 form-check-inline danger m-r-0">
                            <input type="radio" 
                                value="0" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][head][{{ $item }}]" 
                                id="no-{{ $indexing }}-{{ $count }}-head-{{ $item }}" 
                                checked
                            />
                            <label for="no-{{ $indexing }}-{{ $count }}-head-{{ $item }}">NO</label>
                        </div>
                    </div>
                </div>
                @php $item = 'subtitle'; @endphp
                <div class="form-group row">
                    <label class="col-md-5 control-label p-t-0">{{ ucwords($item) }}</label>
                    <div class="col-md-7 text-right">
                        <div class="form-check m-b-0 form-check-inline success">
                            <input type="radio" 
                                value="1" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][head][{{ $item }}]" 
                                id="yes-{{ $indexing }}-{{ $count }}-head-{{ $item }}" 
                            />
                            <label for="yes-{{ $indexing }}-{{ $count }}-head-{{ $item }}">YES</label>
                        </div>
                        <div class="form-check m-b-0 form-check-inline danger m-r-0">
                            <input type="radio" 
                                value="0" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][head][{{ $item }}]" 
                                id="no-{{ $indexing }}-{{ $count }}-head-{{ $item }}" 
                                checked
                            />
                            <label for="no-{{ $indexing }}-{{ $count }}-head-{{ $item }}">NO</label>
                        </div>
                    </div>
                </div>
                @php $item = 'description'; @endphp
                <div class="form-group row">
                    <label class="col-md-5 control-label p-t-0">{{ ucwords($item) }}</label>
                    <div class="col-md-7 text-right">
                        <div class="form-check m-b-0 form-check-inline success">
                            <input type="radio" 
                                value="1" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][head][{{ $item }}]" 
                                id="yes-{{ $indexing }}-{{ $count }}-head-{{ $item }}" 
                            />
                            <label for="yes-{{ $indexing }}-{{ $count }}-head-{{ $item }}">YES</label>
                        </div>
                        <div class="form-check m-b-0 form-check-inline danger m-r-0">
                            <input type="radio" 
                                value="0" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][head][{{ $item }}]" 
                                id="no-{{ $indexing }}-{{ $count }}-head-{{ $item }}" 
                                checked
                            />
                            <label for="no-{{ $indexing }}-{{ $count }}-head-{{ $item }}">NO</label>
                        </div>
                    </div>
                </div>
                @php $item = 'link'; @endphp
                <div class="form-group row">
                    <label class="col-md-5 control-label p-t-0">{{ ucwords($item) }}</label>
                    <div class="col-md-7 text-right">
                        <div class="form-check m-b-0 form-check-inline success">
                            <input type="radio" 
                                value="1" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][head][{{ $item }}]" 
                                id="yes-{{ $indexing }}-{{ $count }}-head-{{ $item }}" 
                            />
                            <label for="yes-{{ $indexing }}-{{ $count }}-head-{{ $item }}">YES</label>
                        </div>
                        <div class="form-check m-b-0 form-check-inline danger m-r-0">
                            <input type="radio" 
                                value="0" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][head][{{ $item }}]" 
                                id="no-{{ $indexing }}-{{ $count }}-head-{{ $item }}" 
                                checked
                            />
                            <label for="no-{{ $indexing }}-{{ $count }}-head-{{ $item }}">NO</label>
                        </div>
                    </div>
                </div>
                @php $item = 'image'; @endphp
                <div class="form-group row number-content">
                    <div class="col-lg-12">
                        <div class="row">
                            <label class="col-md-5 control-label p-t-0">{{ ucwords($item) }}</label>
                            <div class="col-md-7 text-right">
                                <div class="form-check m-b-0 form-check-inline success">
                                    <input type="radio" 
                                        value="1" 
                                        name="config[{{ $indexing }}][list_config][{{ $count }}][head][{{ $item }}]" 
                                        id="yes-{{ $indexing }}-{{ $count }}-head-{{ $item }}" 
                                        class="has-number" 
                                    />
                                    <label for="yes-{{ $indexing }}-{{ $count }}-head-{{ $item }}">YES</label>
                                </div>
                                <div class="form-check m-b-0 form-check-inline danger m-r-0">
                                    <input type="radio" 
                                        value="0" 
                                        name="config[{{ $indexing }}][list_config][{{ $count }}][head][{{ $item }}]" 
                                        id="no-{{ $indexing }}-{{ $count }}-head-{{ $item }}" 
                                        class="has-number" 
                                        checked
                                    />
                                    <label for="no-{{ $indexing }}-{{ $count }}-head-{{ $item }}">NO</label>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10 number-option" style="display: none;">
                            <label class="col-md-8 col-lg-8 col-xl-8 control-label p-t-0">No. of {{ $item }}</label>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <input type="number" 
                                    value="0" 
                                    class="form-control input-sm" 
                                    name="config[{{ $indexing }}][list_config][{{ $count }}][head][no_of_{{ $item }}s]" 
                                    placeholder="Count"
                                />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-t-25">
                    <strong class="col-md-12">Body Configuration:</strong>
                </div>
                @php $item = 'icon'; @endphp
                <div class="form-group row">
                    <label class="col-md-5 control-label p-t-0">{{ ucwords($item) }}</label>
                    <div class="col-md-7 text-right">
                        <div class="form-check m-b-0 form-check-inline success">
                            <input type="radio" 
                                value="1" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][body][{{ $item }}]" 
                                id="yes-{{ $indexing }}-{{ $count }}-body-{{ $item }}" 
                            />
                            <label for="yes-{{ $indexing }}-{{ $count }}-body-{{ $item }}">YES</label>
                        </div>
                        <div class="form-check m-b-0 form-check-inline danger m-r-0">
                            <input type="radio" 
                                value="0" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][body][{{ $item }}]" 
                                id="no-{{ $indexing }}-{{ $count }}-body-{{ $item }}" 
                                checked
                            />
                            <label for="no-{{ $indexing }}-{{ $count }}-body-{{ $item }}">NO</label>
                        </div>
                    </div>
                </div>
                @php $item = 'title'; @endphp
                <div class="form-group row">
                    <label class="col-md-5 control-label p-t-0">{{ ucwords($item) }}</label>
                    <div class="col-md-7 text-right">
                        <div class="form-check m-b-0 form-check-inline success">
                            <input type="radio" 
                                value="1" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][body][{{ $item }}]" 
                                id="yes-{{ $indexing }}-{{ $count }}-body-{{ $item }}"
                            />
                            <label for="yes-{{ $indexing }}-{{ $count }}-body-{{ $item }}">YES</label>
                        </div>
                        <div class="form-check m-b-0 form-check-inline danger m-r-0">
                            <input type="radio" 
                                value="0" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][body][{{ $item }}]" 
                                id="no-{{ $indexing }}-{{ $count }}-body-{{ $item }}" 
                                checked
                            />
                            <label for="no-{{ $indexing }}-{{ $count }}-body-{{ $item }}">NO</label>
                        </div>
                    </div>
                </div>
                @php $item = 'subtitle'; @endphp
                <div class="form-group row">
                    <label class="col-md-5 control-label p-t-0">{{ ucwords($item) }}</label>
                    <div class="col-md-7 text-right">
                        <div class="form-check m-b-0 form-check-inline success">
                            <input type="radio" 
                                value="1" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][body][{{ $item }}]" 
                                id="yes-{{ $indexing }}-{{ $count }}-body-{{ $item }}" 
                            />
                            <label for="yes-{{ $indexing }}-{{ $count }}-body-{{ $item }}">YES</label>
                        </div>
                        <div class="form-check m-b-0 form-check-inline danger m-r-0">
                            <input type="radio" 
                                value="0" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][body][{{ $item }}]" 
                                id="no-{{ $indexing }}-{{ $count }}-body-{{ $item }}" 
                                checked
                            />
                            <label for="no-{{ $indexing }}-{{ $count }}-body-{{ $item }}">NO</label>
                        </div>
                    </div>
                </div>
                @php $item = 'description'; @endphp
                <div class="form-group row">
                    <label class="col-md-5 control-label p-t-0">{{ ucwords($item) }}</label>
                    <div class="col-md-7 text-right">
                        <div class="form-check m-b-0 form-check-inline success">
                            <input type="radio" 
                                value="1" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][body][{{ $item }}]" 
                                id="yes-{{ $indexing }}-{{ $count }}-body-{{ $item }}" 
                            />
                            <label for="yes-{{ $indexing }}-{{ $count }}-body-{{ $item }}">YES</label>
                        </div>
                        <div class="form-check m-b-0 form-check-inline danger m-r-0">
                            <input type="radio" 
                                value="0" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][body][{{ $item }}]" 
                                id="no-{{ $indexing }}-{{ $count }}-body-{{ $item }}" 
                                checked
                            />
                            <label for="no-{{ $indexing }}-{{ $count }}-body-{{ $item }}">NO</label>
                        </div>
                    </div>
                </div>
                @php $item = 'link'; @endphp
                <div class="form-group row">
                    <label class="col-md-5 control-label p-t-0">{{ ucwords($item) }}</label>
                    <div class="col-md-7 text-right">
                        <div class="form-check m-b-0 form-check-inline success">
                            <input type="radio" 
                                value="1" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][body][{{ $item }}]" 
                                id="yes-{{ $indexing }}-{{ $count }}-body-{{ $item }}" 
                            />
                            <label for="yes-{{ $indexing }}-{{ $count }}-body-{{ $item }}">YES</label>
                        </div>
                        <div class="form-check m-b-0 form-check-inline danger m-r-0">
                            <input type="radio" 
                                value="0" 
                                name="config[{{ $indexing }}][list_config][{{ $count }}][body][{{ $item }}]" 
                                id="no-{{ $indexing }}-{{ $count }}-body-{{ $item }}" 
                                checked
                            />
                            <label for="no-{{ $indexing }}-{{ $count }}-body-{{ $item }}">NO</label>
                        </div>
                    </div>
                </div>
                @php $item = 'image'; @endphp
                <div class="form-group row number-content">
                    <div class="col-lg-12">
                        <div class="row">
                            <label class="col-md-5 control-label p-t-0">{{ ucwords($item) }}</label>
                            <div class="col-md-7 text-right">
                                <div class="form-check m-b-0 form-check-inline success">
                                    <input type="radio" 
                                        value="1" 
                                        name="config[{{ $indexing }}][list_config][{{ $count }}][body][{{ $item }}]" 
                                        id="yes-{{ $indexing }}-{{ $count }}-body-{{ $item }}" 
                                        class="has-number" 
                                    />
                                    <label for="yes-{{ $indexing }}-{{ $count }}-body-{{ $item }}">YES</label>
                                </div>
                                <div class="form-check m-b-0 form-check-inline danger m-r-0">
                                    <input type="radio" 
                                        value="0" 
                                        name="config[{{ $indexing }}][list_config][{{ $count }}][body][{{ $item }}]" 
                                        id="no-{{ $indexing }}-{{ $count }}-body-{{ $item }}" 
                                        class="has-number" 
                                        checked
                                    />
                                    <label for="no-{{ $indexing }}-{{ $count }}-body-{{ $item }}">NO</label>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-10 number-option" style="display: none;">
                            <label class="col-md-8 col-lg-8 col-xl-8 control-label p-t-0">No. of {{ $item }}</label>
                            <div class="col-md-4 col-lg-4 col-xl-4">
                                <input type="number" 
                                    value="0" 
                                    class="form-control input-sm" 
                                    name="config[{{ $indexing }}][list_config][{{ $count }}][body][no_of_{{ $item }}s]"
                                    placeholder="Count"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>