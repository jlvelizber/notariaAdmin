import { configureStore } from '@reduxjs/toolkit';
import { SnackSBarSlice } from './slices/SnackBarSlice/SnackBarSlice';



export const store = configureStore({
  reducer: {
    SnackSBarSlice: SnackSBarSlice.reducer
  },
});

// Infer the `RootState` and `AppDispatch` types from the store itself
export type RootState = ReturnType<typeof store.getState>
// Inferred type: {posts: PostsState, comments: CommentsState, users: UsersState}
export type AppDispatch = typeof store.dispatch