export default function iconSelectTableColumn({ name, recordKey, state }) {
    return {
        error: undefined,

        isLoading: false,

        state,

        modal: null,

        offset: 0,

        init() {
            console.log('initialized');
            Livewire.hook(
                'commit',
                ({ component, commit, succeed, fail, respond }) => {
                    succeed(({ snapshot, effect }) => {
                        this.$nextTick(() => {
                            if (this.isLoading) {
                                return
                            }

                            if (
                                component.id !==
                                this.$root.closest('[wire\\:id]').attributes[
                                    'wire:id'
                                    ].value
                            ) {
                                return
                            }

                            const serverState = this.getServerState()

                            if (
                                serverState === undefined ||
                                this.getNormalizedState() === serverState
                            ) {
                                return
                            }

                            this.state = serverState
                        })
                    })
                },
            )

            this.$watch('state', async () => {
                const serverState = this.getServerState()
                console.log('server state', serverState);

                if (
                    serverState === undefined ||
                    this.getNormalizedState() === serverState
                ) {
                    console.log('Do nothing');
                    return
                }
                console.log('update table column state');

                this.isLoading = true

                const response = await this.$wire.updateTableColumnState(
                    name,
                    recordKey,
                    this.state,
                )
                console.log('RESPONSE', response)

                this.error = response?.error ?? undefined

                if (!this.error && this.$refs.serverState) {
                    this.$refs.serverState.value = this.getNormalizedState()
                }

                this.isLoading = false
            })

            // Store modal reference if inside modal
            let element = this.$el;
            while (element != null) {
                if (element.classList && element.classList.contains('fi-modal-window')) {
                    this.modal = element;
                    break;
                }
                element = element.parentElement;
            }
        },

        getServerState() {
            if (!this.$refs.serverState) {
                return undefined
            }

            return [null, undefined].includes(this.$refs.serverState.value)
                ? ''
                : this.$refs.serverState.value.replaceAll(
                    '\\' + String.fromCharCode(34),
                    String.fromCharCode(34),
                )
        },

        getNormalizedState() {
            const state = Alpine.raw(this.state)

            if ([null, undefined].includes(state)) {
                return ''
            }

            return state
        },
    }
}
